<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * ReportSales Controller
 *
 * @method \App\Model\Entity\ReportSale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportSalesController extends AppController
{
    public function index()
    {
        if ($this->request->is('post')) {
            $startDate = $this->request->getData('start_date');
            $endDate = $this->request->getData('end_date');
            $exportType = $this->request->getData('export_type'); 

            $this->loadModel('Sales');

            $sales = $this->Sales->find()
                ->where([
                    'date >=' => FrozenDate::parseDate($startDate, 'yyyy-MM-dd'),
                    'date <=' => FrozenDate::parseDate($endDate, 'yyyy-MM-dd')
                ])
                ->contain(['Customers', 'Motorcycles'])
                ->all();

            if ($exportType == 'html') {
                $this->set(compact('sales'));
                $this->render('html');
            } elseif ($exportType == 'excel') {
                return $this->generateExcel($sales);
            }
        }
    }

    protected function generateExcel($sales)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Transaction Code');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Customer Name');
        $sheet->setCellValue('D1', 'Motorcycle Brand');
        $sheet->setCellValue('E1', 'Quantity');

        $row = 2;
        foreach ($sales as $purchase) {
            $sheet->setCellValue("A{$row}", $purchase->transaction_code);
            $sheet->setCellValue("B{$row}", $purchase->date->format('Y-m-d'));
            $sheet->setCellValue("C{$row}", $purchase->customer->name);
            $sheet->setCellValue("D{$row}", $purchase->motorcycle->brand);
            $sheet->setCellValue("E{$row}", $purchase->quantity);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'sales_report.xlsx';
        $filePath = TMP . $fileName;

        $writer->save($filePath);

        return $this->response->withFile($filePath, ['download' => true, 'name' => $fileName]);
    }
}
