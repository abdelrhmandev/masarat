<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use View;

class FillController extends Controller
{
    public function validateFillForm(Request $request)
    {
        $form_exists = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.pen_id',
                'forms.int_id',
                'forms.status',
                'pens.personal_id',
                'pens.name'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'pens.id', 'fp.pen_id')
            ->leftJoin('form_confirmation_code', 'fp.id', 'form_confirmation_code.form_id')
            ->where('pens.personal_id', '=', $request->id)
            ->where('pens.confirmation_code', '=', $request->confirmation_code);

        if ($form_exists->count() >= 1) {
            $url = url('showInterventions/' . (encrypt($request->id)) . '/' . (encrypt($request->confirmation_code)));
            return redirect($url);
        } else {
            return back()->with('error', trans('messages.error.id-not-found'));
        }
    }

    public function showInterventions($id, $confirmation_code, $int_id = null)
    {
        $id = decrypt($id);
        $confirmation_code = decrypt($confirmation_code);
        if (! is_null($int_id)) {
            $int_id = decrypt($int_id);
        }

        $compact = [];
        $form_exists = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'fp.pen_id',
                'forms.int_id',
                'forms.status',
                'pens.personal_id',
                'pens.name'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'pens.id', 'fp.pen_id')
            ->leftJoin('form_confirmation_code', 'fp.id', 'form_confirmation_code.form_id')
            ->where('pens.personal_id', '=', $id)
            ->where('pens.confirmation_code', '=', $confirmation_code);

        if ($form_exists->count() >= 1) {
            // Start Update Answers From Kashif
            $chackupdate = DB::table('pens')->where('personal_id', '=', $id)->first();
            if ($chackupdate->created_at == $chackupdate->updated_at) {
                $this->updateanswers($id);
            }
            // End Update Answers From Kashif

            $parent_ints_raw = DB::table('int_parent')->get();
            $parent_ints = [];
            $form_answers = [];
            foreach ($parent_ints_raw as $one_parent) {
                $parent_ints[$one_parent->id] = $one_parent->name_ar;
            }

            $ints_raw = DB::table('ints')->get();
            $ints_names = [];
            foreach ($ints_raw as $one) {
                $ints_names[$one->id] = $one->name_short;
            }

            $input_related_ints_raw = DB::table('input_related_ints')->select('int_id')->get();
            $input_related_ints = [];
            foreach ($input_related_ints_raw as $one) {
                $input_related_ints[] = $one->int_id;
            }

            $forms_raw = DB::table('forms')
                ->select(
                    'forms.id AS form_id',
                    'forms.status',
                    'ints.name_short AS name',
                    'ints.parent',
                    'ints.image',
                    'pens.id as pens_id',
                    'ints.id AS int_id'
                )
                ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
                ->leftJoin('pens', 'pens.id', 'fp.pen_id')
                ->leftJoin('ints', 'ints.id', 'forms.int_id')
                ->where('forms.status', '>=', '1')
                ->whereIn('ints.id', $input_related_ints)
                ->where('pens.personal_id', '=', $id)
                ->get();

            $forms = [];
            $forms_only_ids = [];
            if ($forms_raw->count() < 1) {
                return back()->with('info', 'بياناتكم مكتملة وليس هناك حاجة لرفع بيانات من قبلكم');
            }

            foreach ($forms_raw as $one) {
                $forms[$one->parent][] = $one;
                $submittionAnswers = DB::table('form_submission')
                    ->select(
                        'fsa.answer as answer',
                        'qu.int_key as int_key',
                    )
                    ->leftJoin('form_submission_answers AS fsa', 'fsa.submission_id', 'form_submission.id')
                    ->leftJoin('int_questions AS qu', 'fsa.question_id', 'qu.id')
                    ->where('form_submission.form_id', '=', $one->form_id)
                    ->pluck('answer', 'int_key');

                if ($submittionAnswers->count() >= 1) {
                    $form_answers[$one->form_id] = $submittionAnswers;

                }
                $forms_only_ids[] = $one->form_id;
            }

            $questions_in_details = [];
            $questions_list = DB::table('int_questions')
                ->select(
                    'int_questions.id AS question_id',
                    'int_questions.int_id AS int_id',
                    'int_questions.name_ar AS name',
                    'int_questions.description_ar as question_description',
                    'int_questions.question_type',
                    'int_questions.is_required',
                    'int_questions.is_disabled',
                    'int_questions.attribute',
                    'int_questions.int_key',
                    'forms.id AS form_id'
                )
                ->leftJoin('ints', 'int_questions.int_id', 'ints.id')
                ->leftJoin('forms', 'forms.int_id', 'ints.id')
                ->whereIn('forms.id', $forms_only_ids)
                ->orderBy('form_id', 'ASC')
                ->get();

            $questions_in_details = [];
            foreach ($questions_list as $one) {
                $all_questions_imploded = "";
                $questions_in_details[$one->form_id][$one->question_id]['question_id'] = $one->question_id;
                $questions_in_details[$one->form_id][$one->question_id]['int_id'] = $one->int_id;
                $questions_in_details[$one->form_id][$one->question_id]['name'] = $one->name;
                $questions_in_details[$one->form_id][$one->question_id]['question_type'] = $one->question_type;
                $questions_in_details[$one->form_id][$one->question_id]['is_required'] = $one->is_required;
                $questions_in_details[$one->form_id][$one->question_id]['is_disabled'] = $one->is_disabled;
                $questions_in_details[$one->form_id][$one->question_id]['question_description'] = $one->question_description;
                $questions_in_details[$one->form_id][$one->question_id]['attribute'] = $one->attribute;
                $questions_in_details[$one->form_id][$one->question_id]['form_id'] = $one->form_id;
                $data = [
                    'required' => $one->is_required,
                    'disabled' => $one->is_disabled,
                    'question_id' => $one->question_id,
                    'text' => $one->name,
                    'description' => $one->question_description,
                    'attribute' => $one->attribute,
                    'int_id' => $one->int_id,
                    'form_id' => $one->form_id,
                ];

                $all_questions_imploded .= (string) View::make('partials.question-' . $one->question_type, $data);
                $questions_in_details[$one->form_id]['questions'][] = $all_questions_imploded;
                $questions_in_details[$one->form_id]['form_id'] = $one->form_id;
                $questions_in_details[$one->form_id]['int_id'] = $one->int_id;
            }

            $compact['forms'] = $forms;
            $compact['form_answers'] = $form_answers;
            $compact['parent_ints'] = $parent_ints;
            $compact['questions_in_details'] = $questions_in_details;
            $compact['ints_names'] = $ints_names;
            $compact['id'] = $id;
            $compact['confirmation_code'] = $confirmation_code;
            $compact['int_id'] = $int_id;
            $compact['total'] = count($forms_raw->where('status', '>=', 1));

            return view('forms.home', $compact);
        } else {
            return back()->with('error', trans('messages.error.id-not-found'));
        }
    }

    public function answers(Request $request)
    {
        $request_pars = $request->all();
        $questions_object_raw = DB::table('int_questions AS iq')->select('*')->get();
        $questions_object = [];
        foreach ($questions_object_raw as $one_object) {
            $questions_object[$one_object->id] = $one_object;
        }

        // Start handling submitted data
        $insertions = [];
        $dataX = [];
        foreach ($request_pars['answers'] as $question_id => $answer) {
            $the_answer = null;
            if ($questions_object[$question_id]->question_type == 'file') {
                $file = $answer;
                if ($file->getSize() > 5000000) {
                    return back()->with('error', trans('messages.error.maximum_upload_size_5_mega'));
                }
            }
        }

        $form_id = $request_pars['form_id'];
        $pen_id = DB::table('forms')
            ->select('fp.pen_id')
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->where('forms.id', '=', $form_id)
            ->first()->pen_id;

        $submitted_int = DB::table('form_submission')
            ->select('id')
            ->where('form_id', '=', $form_id)
            ->first();

        $submission_id = '';
        if ($submitted_int == null) {
            $submission_id = DB::table('form_submission')->insertGetId(['form_id' => $form_id, 'pen_id' => $pen_id, 'is_confirmed' => '0', 'created_at' => date("Y-m-d H:i:s")]);
        } else {
            $submission_id = $submitted_int->id;
        }

        foreach ($request_pars['answers'] as $question_id => $answer) {
            $the_answer = $answer;
            if ($questions_object[$question_id]->question_type == 'file') {
                if ($questions_object[$question_id]->attribute == 'multiple') {
                    foreach ($answer as $image) {
                        $file = $image;
                        $the_answer = uniqid() . '.' . $file->extension();
                        $destinationPath = public_path('/uploads/imgs/');
                        $img = Image::make($file->path());
                        $img->resize(700, 650, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destinationPath . '/' . $the_answer);
                        $dataX[] = [
                            'question_id' => $question_id,
                            'submission_id' => $submission_id,
                            'answer' => url('uploads/imgs/' . $the_answer),
                        ];
                    }
                    $the_answer = $dataX;
                } else {
                    $file = $answer;
                    $the_answer = uniqid() . '.' . $file->extension();
                    $destinationPath = public_path('/uploads/imgs/');
                    $img = Image::make($file->path());
                    $img->resize(700, 650, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $the_answer);
                    $the_answer = url('uploads/imgs/' . $the_answer);
                }
            } else if ($questions_object[$question_id]->question_type == 'pdf') {
                $pdf = $answer;
                if (isset($pdf)) {
                    $the_pdf_multiple_1 = uniqid() . '.' . File::extension($pdf->getClientOriginalName());
                    $pdf->move(base_path('public/uploads/pdf/'), $the_pdf_multiple_1);
                }
                $the_answer = url('uploads/pdf/' . $the_pdf_multiple_1);
            }

            if (! is_array($the_answer)) {
                $insertions[] = [
                    'question_id' => $question_id,
                    'submission_id' => $submission_id,
                    'answer' => $the_answer,
                ];
            }
        }

        if (! empty($insertions) && DB::table('form_submission_answers')->insert($insertions)) {
            if (isset($dataX)) {
                DB::table('form_submission_answers')->insert($dataX);
            }

            DB::table('forms')->where('id', '=', $form_id)->update(['status' => '2']);
            $loginsertions[] = ['user_id' => '0', 'form_id' => $form_id, 'status_id' => '2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];
            DB::table('transactions_history')->insert($loginsertions);
            return back()->with('success', trans('messages.success.data-inserted'));
        }
    }

    public function updateAnswers($personal_id)
    {
        $forms_raw = DB::table('forms')
            ->select(
                'forms.id AS form_id',
                'forms.status',
                'ints.name_short AS name',
                'ints.parent',
                'ints.image',
                'pens.id as pens_id',
                'ints.id AS int_id'
            )
            ->leftJoin('forms_parent AS fp', 'fp.id', 'forms.forms_parent_id')
            ->leftJoin('pens', 'pens.id', 'fp.pen_id')
            ->leftJoin('ints', 'ints.id', 'forms.int_id')
            ->where('forms.status', '>=', '1')->where('pens.personal_id', '=', $personal_id)->get();

        foreach ($forms_raw as $one) {
            $pen_id = $one->pens_id;
            $submitted_int = DB::table('form_submission')->select('id')->where('form_id', '=', $one->form_id)->first();
            $submission_id = '';

            $questions = DB::table('int_questions')
                ->LeftJoin('form_extra AS ex', 'ex.key', 'int_questions.int_key')
                ->where('ex.pen_id', $pen_id)->where('ex.form_id', $one->form_id)->where('int_questions.int_id', $one->int_id)->where('int_questions.is_disabled', '1')
                ->select(
                    'ex.form_id as form_id',
                    'ex.int_id as int_id',
                    'ex.key',
                    'ex.value',
                    'int_questions.id as questions_id',
                    'int_questions.int_id as questions_from_id',
                    'int_questions.int_key',
                )->get();

            if (sizeof($questions) > 0) {
                if ($submitted_int == null) {
                    $submission_id = DB::table('form_submission')->insertGetId(['form_id' => $one->form_id, 'pen_id' => $pen_id, 'is_confirmed' => '0', 'created_at' => date("Y-m-d H:i:s")]);
                    $insertions = [];

                    foreach ($questions as $question) {
                        $insertions[] = [
                            'question_id' => $question->questions_id,
                            'submission_id' => $submission_id,
                            'answer' => $question->value,
                        ];
                    }
                    if (! empty($insertions)) {
                        DB::table('form_submission_answers')->insert($insertions);
                    }
                }

                DB::table('pens')->where('personal_id', '=', $personal_id)->update(['updated_at' => date('Y-m-d H:i:s')]);
            }
        }
    }
}