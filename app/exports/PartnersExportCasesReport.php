<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Encore\Admin\Facades\Admin;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PartnersExportCasesReport implements FromView, WithEvents
{
    public function __construct($request)
    {
        $this->request = $request;
        $this->CASES_SERVICE      = app('App\Admin\Services\CasesService');
        $this->NAVIGATION_SERVICE = app('App\Admin\Services\NavigationService');
        $this->COMMON_SERVICE     = app('App\Admin\Services\CommonService');
        return $this;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $event->sheet->getDelegate()->setRightToLeft(true);

                $header_table_headers = $sheet->getStyle('A2:' . $sheet->getHighestDataColumn() . '2');
                $header_table_headers->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $header_table_headers->getFont()->setBold(true);
                $header_table_headers->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00008B');
                $header_table_headers->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

                $header_values = $sheet->getStyle('A3:' . $sheet->getHighestDataColumn() . '3');
                $header_values->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $header_values->getFont()->setBold(true);
                $header_values->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('4682B4');
                $header_values->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

                $other = $sheet->getStyle('A4:' . $sheet->getHighestDataColumn() . $sheet->getHighestRow());
                $other->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

                foreach ([$header_table_headers, $other] as $item) {
                    $item->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    $item->getAlignment()->setWrapText(true);
                }

                foreach ([$header_values, $other] as $item) {
                    $item->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    $item->getAlignment()->setWrapText(true);
                }
            },
        ];
    }

    public function view(): View
    {
        $VIEWS_INTERVENTION_EXPORT = 'tailAdmin.pages.intervention.exportInt';
        $current_url                        = url('admin/' . Admin::user()->roles[0]->slug . '/ints/' . $this->request->details_id);
        $cases                              = $this->CASES_SERVICE->getFilteredCasesWithAnswersByIntId_Export($this->request, $this->request->details_id)->get();
        $answers                            = $this->CASES_SERVICE->getCasesAnswersFromObject($cases);
        $columnsAnswers                     = $this->CASES_SERVICE->getColumnsAnswers($this->request);
        $viewTitles                         = $this->COMMON_SERVICE->getViewsTitles($this->request);

        $compact                            = [
            'cases'                         => $cases,
            'answers'                       => $answers,
            'current_url'                   => $current_url,
            'details_id'                    => $this->request->details_id,
            'columns'                       => $columnsAnswers['columns'],
            'colum_type_by_id'              => $columnsAnswers['colum_type_by_id'],
            'providers'                     => $columnsAnswers['providers'],
            'page_title'                    => trans($viewTitles['page_title']),
            'header_title'                  => str_replace('_', ' ', preg_replace('/\d+/', '', trans($viewTitles['header_title']))),
            'ints_status_url'               => 'ints',
        ];

        return view($VIEWS_INTERVENTION_EXPORT, $compact);
    }
}
