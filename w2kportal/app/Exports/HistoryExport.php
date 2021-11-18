<?php

namespace App\Exports;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InclusionsLogController;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoryExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;
    private $id;
    private $log;
    private $inclusion_fields;
    private $sheet;


    public function __construct($id)
    {
        $this->id = $id;
        $this->log = new InclusionsLogController;
        $this->customer = new CustomerController;
        $this->inclusion_fields = [
            'service_inclusions.service_name AS serName',
            'inclusions_logs.layout',
            'inclusions_logs.layout_by',
            'inclusions_logs.page_count',
            'inclusions_logs.page_count_by',
            'inclusions_logs.project_classification',
            'inclusions_logs.project_classification_by',
            'inclusions_logs.turnaround_time',
            'inclusions_logs.turnaround_time_by',
            'inclusions_logs.status',
            'inclusions_logs.status_by',
            'inclusions_logs.commitment_date',
            'inclusions_logs.commitment_date_by',
            'inclusions_logs.owner',
            'inclusions_logs.owner_by',
            'inclusions_logs.job_cost',
            'inclusions_logs.job_cost_by',
            'inclusions_logs.date_assigned',
            'inclusions_logs.date_assigned_by',
            'inclusions_logs.date_completed',
            'inclusions_logs.date_completed_by',
            'inclusions_logs.quality_assurance',
            'inclusions_logs.quality_assurance_by',
            'inclusions_logs.quality_score',
            'inclusions_logs.quality_score_by',
            'inclusions_logs.uid',
            'inclusions_logs.uid_by',
            'inclusions_logs.project_link',
            'inclusions_logs.project_link_by',
            'inclusions_logs.created_at',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        return $this->log->get_history_by_id($this->id, $this->inclusion_fields);
    }


    public function headings(): array
    {
        return [
            'Service Name',
            'Layout',
            'Layout By',
            'Page Count',
            'Page Count By',
            'Project Classification',
            'Project Classification By',
            'Turn Around Time',
            'Turn Around Time By',
            'Status',
            'Status By',
            'Commitment Date',
            'Commitment Date By',
            'Owner',
            'Owner By',
            'Job Cost',
            'Job Cost By',
            'Date Assigned',
            'Date Assigned By',
            'Date Completed',
            'Date Completed By',
            'Quality Assurance',
            'Quality Assurance By',
            'Quality Score',
            'Quality Score By',
            'UID',
            'UID By',
            'Project Link',
            'Project Link By',
            'Date Created'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $heading_base = array_merge(range('A', 'Z'), ['AA', 'AB', 'AC', 'AD']);
        $heading_range = [];
        foreach ($heading_base as $key => $value) {

            $sheet->getRowDimension(1)->setRowHeight(70);

            $sheet->getStyle($value . '1')->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => ['argb' => '000000'],
                    ]
                ]
            ]);

            # FOR HEADINGS
            $heading_range[$value . '1'] = [
                'font' => [
                    'size'  => 13,
                    'name'  => 'Montserrat'
                ],

                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],

                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFFF00']
                ],
            ];

            #DATA AFTER HEADING
            $heading_range[$value] = [
                'font' => ['size' => 16,],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],


            ];
        }

        return $heading_range;
    }
}
