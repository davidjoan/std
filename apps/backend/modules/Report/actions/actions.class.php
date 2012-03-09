<?php

/**
 * Report actions.
 *
 * @package    std
 * @subpackage Report
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportActions extends ActionsProject {

    public function executePrintRecordList(sfWebRequest $request) {
        $slugs = $request->getParameter('slug');
        $slugs = explode(',', $slugs);
        $this->forward404Unless($slugs);

        $objPHPExcel = new sfPhpExcel();
        $username = $this->getUser()->getUsername();
        
        $records = Doctrine::getTable('Record')->findBySlugs($slugs);
// Set properties

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Usuario');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Fecha');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', date('d/m/Y h:m:i'));
        $objPHPExcel->getActiveSheet()->setCellValue('I1', $username);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('E6', 'LISTADO DE EXPEDIENTES');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('B10', 'ITEM');
        $objPHPExcel->getActiveSheet()->setCellValue('C10', 'COD. EXPEDIENTE');
        $objPHPExcel->getActiveSheet()->setCellValue('D10', 'FECHA EMISION');
        $objPHPExcel->getActiveSheet()->setCellValue('E10', 'ASUNTO');
        $objPHPExcel->getActiveSheet()->setCellValue('F10', 'Nro DOCS');
        $objPHPExcel->getActiveSheet()->setCellValue('G10', 'ESTADO');
        $objPHPExcel->getActiveSheet()->setCellValue('H10', 'USUARIO ACTUAL');
        $objPHPExcel->getActiveSheet()->setCellValue('I10', 'FECHA DE MOVIMIENTO');
        $objPHPExcel->getActiveSheet()->getStyle('B10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I10')->getFont()->setBold(true);
        
        $init_row = 11;
        foreach($records as $key => $record)
        {
          $init_row = $init_row + $key;
          
          $objPHPExcel->getActiveSheet()->setCellValue('B'.$init_row, $key+1);
          $objPHPExcel->getActiveSheet()->setCellValue('C'.$init_row, $record->getCode());
          $objPHPExcel->getActiveSheet()->setCellValue('D'.$init_row, $record->getFormattedDatetime());
          $objPHPExcel->getActiveSheet()->setCellValue('E'.$init_row, $record->getSubject());
          $objPHPExcel->getActiveSheet()->setCellValue('F'.$init_row, $record->getQtyDocs());
          $objPHPExcel->getActiveSheet()->setCellValue('G'.$init_row, $record->getStatusStr());
          $objPHPExcel->getActiveSheet()->setCellValue('H'.$init_row, $record->getUserName());
          $objPHPExcel->getActiveSheet()->setCellValue('I'.$init_row, $record->getFormattedUpdatedAt());              
          
         
        }        
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(33);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(19);
        
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath(sfConfig::get('sf_web_dir') .'/images/general/logo.jpg');
        $objDrawing->setHeight(36);
        
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        $objPHPExcel->setActiveSheetIndex(0);
        
        $objPHPExcel->getActiveSheet()->setAutoFilter('B10:I'.$init_row);



// Save Excel 2007 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Content-Type: application/vnd.ms-excel.sheet.macroEnabled.12"); 
        header("Content-Disposition: inline; filename=report.xlsx");
                      
        $objWriter->save('php://output');
        //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
        
        throw new sfStopException();
    }

    /* public function executePrintRecordList(sfWebRequest $request)
      {
      $slugs = $request->getParameter('slug');
      $slugs = explode(',', $slugs);
      $this->forward404Unless($slugs);

      try
      {
      Doctrine::getTable($this->modelClass)->deleteBySlugs($slugs);
      }
      catch (sfExceptionExt $e)
      {
      $this->redirect('@error_delete_error');
      }

      $this->redirect($this->getEntranceRoute());





      $username = $this->getUser()->getUsername();


      $pdf = new RecordListPDF('L', 'mm', 'A4', $username);

      $pdf->AddPage();
      $pdf->Ln(10);

      $pdf->Image(sfConfig::get('sf_web_dir') .'/images/general/logo.jpg',10,8,33);
      $pdf->SetFont('Arial','B',12);
      $pdf->SetTextColor(222,184,135);
      $pdf->Cell(0,5,'Datos del Titular',0,1);
      $pdf->Ln(3);
      $pdf->SetTextColor(0);


      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(20,5,'ITEM',1,0,'C');
      $pdf->Cell(35,5,'COD. EXPEDIENTE',1,0,'C');
      $pdf->Cell(40,5,'FECHA EMISION',1,0,'C');
      $pdf->Cell(65,5,'ASUNTO',1,0,'C');
      $pdf->Cell(20,5,'Nro DOCS',1,0,'C');
      $pdf->Cell(20,5,'ESTADO',1,0,'C');
      $pdf->Cell(35,5,'USUARIO ACTUAL',1,0,'C');
      $pdf->Cell(30,5,'FECHA DE MOV',1,0,'C');
      $pdf->Ln();


      $header = array('Doctor', 'Especialidad', 'Correo', 'Telefono');
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B',12);
      $pdf->SetTextColor(222,184,135);
      $pdf->Cell(0,5,'Mis Doctores',0,1);
      $pdf->Ln(3);
      $pdf->SetTextColor(0);

      $data = $profile->getReportDoctors();
      $pdf->DoctorTable($header,$data);


      $pdf->Ln(30);
      $firma = 'Firma del Médico Tratante';
      $pdf->Cell(60);
      $pdf->Cell(58,5,utf8_decode($firma),'T',0,'C');

      $pdf->Output('reporte.pdf','D');
      //$pdf->Output();

      throw new sfStopException();
      } */
}
