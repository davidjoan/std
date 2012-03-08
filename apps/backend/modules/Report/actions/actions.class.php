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
// Set properties

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Usuario');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Fecha');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', date('d/m/Y h:m:i'));
        $objPHPExcel->getActiveSheet()->setCellValue('I1', $username);
        
        $objPHPExcel->getActiveSheet()->setCellValue('D6', 'LISTADO DE EXPEDIENTES');
        
        $objPHPExcel->getActiveSheet()->setCellValue('B10', 'ITEM');
        $objPHPExcel->getActiveSheet()->setCellValue('C10', 'COD. EXPEDIENTE');
        $objPHPExcel->getActiveSheet()->setCellValue('D10', 'FECHA EMISION');
        $objPHPExcel->getActiveSheet()->setCellValue('E10', 'ASUNTO');
        $objPHPExcel->getActiveSheet()->setCellValue('F10', 'Nro DOCS');
        $objPHPExcel->getActiveSheet()->setCellValue('G10', 'ESTADO');
        $objPHPExcel->getActiveSheet()->setCellValue('H10', 'USUARIO ACTUAL');
        $objPHPExcel->getActiveSheet()->setCellValue('I10', 'FECHA DE MOVIMIENTO');
        
        
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath(sfConfig::get('sf_web_dir') .'/images/general/logo.jpg');
        $objDrawing->setHeight(36);
        
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

        							

// Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        $objPHPExcel->getActiveSheet()->setAutoFilter('B10:J10');	// Always include the complete filter range!



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
