<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PerformanceSummaryExcelExport implements
    FromArray,
    WithEvents
{
    protected Collection $summary;
    protected Collection $criteria;

    public function __construct(Collection $summary, Collection $criteria)
    {
        $this->summary  = $summary;
        $this->criteria = $criteria;
    }

    public function array(): array
    {
        $data = [];

        $row1 = ["NO", "NIK", "Nama Karyawan", "Departemen"];

        foreach ($this->criteria as $c) {
            $nama  = strtoupper($c->name);
            $bobot = intval($c->weight) . "%";

            $row1[] = $nama . " " . $bobot;
        }

        $row1[] = "TOTAL";
        $row1[] = "PERSEN";

        $row2 = ["", "", "", ""];

        foreach ($this->criteria as $c) {
            $row2[] = "SKOR";
        }

        $row2[] = "";
        $row2[] = "";

        $data[] = $row1;
        $data[] = $row2;

        foreach ($this->summary as $i => $s) {

            $row = [
                $i + 1,
                $s['nik'],
                $s['name'],
                $s['dept'],
            ];

            foreach ($this->criteria as $c) {
                $skor = (float) ($s['rows'][$c->id]['skor'] ?? 0);
                $row[] = round($skor, 2);
            }

            $total  = $s['total'] ?? 0;
            $persen = ($total / 5) * 100;

            $row[] = round($total, 2);
            $row[] = round($persen) . "%";

            $data[] = $row;
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $highestColumn = $sheet->getHighestColumn();
                $highestRow    = $sheet->getHighestRow();

                $totalColIndex = Coordinate::columnIndexFromString($highestColumn);

                $sheet->mergeCells("A1:A2");
                $sheet->mergeCells("B1:B2");
                $sheet->mergeCells("C1:C2");
                $sheet->mergeCells("D1:D2");

                $sheet->mergeCellsByColumnAndRow($totalColIndex - 1, 1, $totalColIndex - 1, 2);
                $sheet->mergeCellsByColumnAndRow($totalColIndex, 1, $totalColIndex, 2);

                $sheet->getStyle("A1:$highestColumn"."1")->applyFromArray([
                    "font" => ["bold" => true, "size" => 10],
                    "alignment" => [
                        "horizontal" => Alignment::HORIZONTAL_CENTER,
                        "vertical"   => Alignment::VERTICAL_CENTER,
                        "wrapText"   => true,
                    ],
                    "fill" => [
                        "fillType" => Fill::FILL_SOLID,
                        "startColor" => ["rgb" => "D9D9D9"],
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(22);
                $sheet->getRowDimension(2)->setRowHeight(15);

                $sheet->getStyle("A2:$highestColumn"."2")->applyFromArray([
                    "font" => ["bold" => true, "size" => 9],
                    "alignment" => [
                        "horizontal" => Alignment::HORIZONTAL_CENTER,
                        "vertical"   => Alignment::VERTICAL_CENTER,
                    ],
                    "fill" => [
                        "fillType" => Fill::FILL_SOLID,
                        "startColor" => ["rgb" => "D9D9D9"],
                    ],
                ]);

                $sheet->getColumnDimension("A")->setWidth(5);
                $sheet->getColumnDimension("B")->setWidth(12);
                $sheet->getColumnDimension("C")->setWidth(25);
                $sheet->getColumnDimension("D")->setWidth(18);

                $col = 5;
                while ($col <= $totalColIndex - 2) {
                    $sheet->getColumnDimensionByColumn($col)->setWidth(12);
                    $col++;
                }

                $sheet->getStyle("D1:$highestColumn"."1")->applyFromArray([
                    "alignment" => [
                        "shrinkToFit" => true,
                    ],
                ]);

                $sheet->getStyle("A3:$highestColumn$highestRow")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical'   => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle("C3:C$highestRow")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                    ],
                ]);
                $col = 5;
                $lastCriteriaCol = $totalColIndex - 2;

                while ($col <= $lastCriteriaCol) {
                    $sheet->getStyleByColumnAndRow($col, 2,)
                        ->getFont()->getColor()->setRGB('0070C0');
                    $sheet->getStyleByColumnAndRow($col, 3, $col, $highestRow)
                        ->getFont()->getColor()->setRGB('0070C0');
                    $col++;
                }

                $sheet->getStyleByColumnAndRow($totalColIndex - 1, 3, $totalColIndex, $highestRow)
                    ->getFont()->getColor()->setRGB("000000");

                $dataRowIndex = 0;
                for ($row = 3; $row <= $highestRow; $row++) {
                    $color = ($dataRowIndex % 2 === 0) ? 'EDEDED' : 'F2F2F2';
                    $sheet->getStyle("A$row:$highestColumn$row")->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setRGB($color);
                    $dataRowIndex++;
                }

                $sheet->getStyle("A1:$highestColumn$highestRow")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                    ],
                ]);
            }
        ];
    }
}
