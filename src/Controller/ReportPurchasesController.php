<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportPurchasesController extends AppController
{

    public function index()
    {
        if ($this->request->is('post')) {
            $startDate = $this->request->getData('start_date');
            $endDate = $this->request->getData('end_date');
            $exportType = $this->request->getData('export_type'); 

            // Load Purchases model
            $this->loadModel('Purchases');

            // Fetch purchases
            $purchases = $this->Purchases->find()
                ->where([
                    'date >=' => FrozenDate::parseDate($startDate, 'yyyy-MM-dd'),
                    'date <=' => FrozenDate::parseDate($endDate, 'yyyy-MM-dd')
                ])
                ->contain(['Customers', 'Motorcycles'])
                ->all();

            if ($exportType == 'html') {
                // Tampilkan data dalam bentuk HTML
                $this->set(compact('purchases'));
                $this->render('html');
            } elseif ($exportType == 'excel') {
                // Export ke Excel
                return $this->generateExcel($purchases);
            }
        }
    }

    protected function generateExcel($purchases)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Transaction Code');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Customer Name');
        $sheet->setCellValue('D1', 'Motorcycle Brand');
        $sheet->setCellValue('E1', 'Quantity');

        $row = 2;
        foreach ($purchases as $purchase) {
            $sheet->setCellValue("A{$row}", $purchase->transaction_code);
            $sheet->setCellValue("B{$row}", $purchase->date->format('Y-m-d'));
            $sheet->setCellValue("C{$row}", $purchase->customer->name);
            $sheet->setCellValue("D{$row}", $purchase->motorcycle->brand);
            $sheet->setCellValue("E{$row}", $purchase->quantity);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'purchases_report.xlsx';
        $filePath = TMP . $fileName;

        $writer->save($filePath);

        return $this->response->withFile($filePath, ['download' => true, 'name' => $fileName]);
    }
}
