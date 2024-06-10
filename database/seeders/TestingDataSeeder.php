<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Main forms insertion
        $forms_insertions               = [
            [
                'pen_id'                => 1,
                'int_id'                => 1,
                'family_count'          => 9,
                'able_to_work'          => 2,
                'need'                  => 30,
                'development'           => 50,
                'status'                => 2,
                'role_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ],
            [
                'pen_id'                => 1,
                'int_id'                => 2,
                'family_count'          => 9,
                'able_to_work'          => 2,
                'need'                  => 30,
                'development'           => 50,
                'status'                => 2,
                'role_id'               => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('forms')->insert($forms_insertions);

        $form_submissions_insertions        = [
            [
                'form_id'               => 1,
                'pen_id'                => 1,
                'is_confirmed'          => 0,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'form_id'               => 2,
                'pen_id'                => 1,
                'is_confirmed'          => 0,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'form_id'               => 3,
                'pen_id'                => 1,
                'is_confirmed'          => 0,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('form_submission')->insert($forms_insertions);

        $form_submission_answers_insertions         = [
            [
                'question_id'                       => 3,
                'submission_id'                     => 1,
                'answer'                            => '30',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 4,
                'submission_id'                     => 1,
                'answer'                            => '4000',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 5,
                'submission_id'                     => 1,
                'answer'                            => '0583647586',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 1,
                'submission_id'                     => 1,
                'answer'                            => 'http://localhost/masarat2/public/uploads/61f9035f90a12.png',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 2,
                'submission_id'                     => 1,
                'answer'                            => 'http://localhost/masarat2/public/uploads/61f9035f90a12.png',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 7,
                'submission_id'                     => 2,
                'answer'                            => '300',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 8,
                'submission_id'                     => 2,
                'answer'                            => '2022-03-01',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 9,
                'submission_id'                     => 2,
                'answer'                            => 'Test Owner',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 10,
                'submission_id'                     => 2,
                'answer'                            => '0538475647',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
            [
                'question_id'                       => 6,
                'submission_id'                     => 2,
                'answer'                            => 'http://localhost/masarat2/public/uploads/61f90377204c3.png',
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('form_submission_answers')->insert($form_submission_answers_insertions);

    }
}
