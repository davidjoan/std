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
        
        $init_row = 10;
        foreach($records as $key => $record)
        {
          $init_row++;
          
          $objPHPExcel->getActiveSheet()->setCellValue('B'.$init_row, $key+1);
          $objPHPExcel->getActiveSheet()->setCellValue('C'.$init_row, $record->getCode());
          $objPHPExcel->getActiveSheet()->setCellValue('D'.$init_row, $record->getFormattedDatetime());
          $objPHPExcel->getActiveSheet()->setCellValue('E'.$init_row, $record->getSubject());
          $objPHPExcel->getActiveSheet()->setCellValue('F'.$init_row, $record->getQtyDocs());
          $objPHPExcel->getActiveSheet()->setCellValue('G'.$init_row, $record->getStatusStr());
          $objPHPExcel->getActiveSheet()->setCellValue('H'.$init_row, $record->getUserName());
          $objPHPExcel->getActiveSheet()->setCellValue('I'.$init_row, $record->getFormattedUpdatedAt());              
          
         
        }      
        
        $objPHPExcel->getActiveSheet()->setCellValue('C'.($init_row+2), 'Total de Registros:');
        $objPHPExcel->getActiveSheet()->getStyle('C'.($init_row+2))->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.($init_row+2), '=COUNT(B11:B'.$init_row.')');
        
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


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Content-Type: application/vnd.ms-excel.sheet.macroEnabled.12"); 
        header("Content-Disposition: inline; filename=reporte_total.xlsx");
                      
        $objWriter->save('php://output');
        
        throw new sfStopException();
    }

    public function executePrintRecord(sfWebRequest $request) {
        $slug = $request->getParameter('slug');
        
        $this->forward404Unless($slug);

        $objPHPExcel = new sfPhpExcel();
        $username    = $this->getUser()->getUsername();
        
        $record = Doctrine::getTable('Record')->findOneBySlug($slug);   

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Usuario');
        $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Fecha');
        $objPHPExcel->getActiveSheet()->setCellValue('I2', date('d/m/Y h:m:i'));
        $objPHPExcel->getActiveSheet()->setCellValue('I1', $username);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('E6', 'DETALLE DE EXPEDIENTE');
        $objPHPExcel->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
        
        
        
        //////////////////////////////////////
        $objPHPExcel->getActiveSheet()->setCellValue('A7', 'I. Datos del expediente');
        $objPHPExcel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
        
        $objPHPExcel->getActiveSheet()->setCellValue('A8', 'Cód. Expediente:');
        $objPHPExcel->getActiveSheet()->getStyle('A8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B8', $record->getCode());
        
        
        $objPHPExcel->getActiveSheet()->setCellValue('A9', 'Remitente:');
        $objPHPExcel->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B9', $record->getAreaName());
        
        $objPHPExcel->getActiveSheet()->setCellValue('A10', 'Asunto:');
        $objPHPExcel->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('B10', $record->getSubject());
        
        $objPHPExcel->getActiveSheet()->setCellValue('G8', 'Fecha:');
        $objPHPExcel->getActiveSheet()->getStyle('G8')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('H8', $record->getFormattedDatetime());
        
        
        $objPHPExcel->getActiveSheet()->setCellValue('G10', '# Docs:');
        $objPHPExcel->getActiveSheet()->getStyle('G10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('H10', $record->getQtyDocs());
        
        $objPHPExcel->getActiveSheet()->setCellValue('A12', 'II. Documentos contenidos');
        $objPHPExcel->getActiveSheet()->getStyle('A12')->getFont()->setBold(true);
        
        
        //Item	Tipo	Número		Fecha	Remitente		Asunto	

        $objPHPExcel->getActiveSheet()->setCellValue('A13', 'Item');
        $objPHPExcel->getActiveSheet()->setCellValue('B13', 'Tipo');
        $objPHPExcel->getActiveSheet()->setCellValue('C13', 'Número');
        $objPHPExcel->getActiveSheet()->setCellValue('D13', 'Fecha');
        $objPHPExcel->getActiveSheet()->setCellValue('E13', 'Remitente');
        $objPHPExcel->getActiveSheet()->setCellValue('F13', 'Asunto');
        $objPHPExcel->getActiveSheet()->getStyle('A13')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B13')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C13')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D13')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E13')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F13')->getFont()->setBold(true);

        $init_row = 14;
    
        foreach($record->getDocuments() as $key => $document)
        {
          $init_row = $init_row + $key;
          
          $objPHPExcel->getActiveSheet()->setCellValue('A'.$init_row, $key+1);
          $objPHPExcel->getActiveSheet()->setCellValue('B'.$init_row, $document->getDocumentClassName());
          $objPHPExcel->getActiveSheet()->setCellValue('C'.$init_row, $document->getCode());
          $objPHPExcel->getActiveSheet()->setCellValue('D'.$init_row, $document->getDocumentDate());
          $objPHPExcel->getActiveSheet()->setCellValue('E'.$init_row, $document->getDescription());
          $objPHPExcel->getActiveSheet()->setCellValue('F'.$init_row, $document->getMain());         
        }      
        
        
        $init_row++;
        $init_row++;
        
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$init_row, 'III. Detalle de movimientos (Ordenados por fecha de movimiento descendente)');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$init_row)->getFont()->setBold(true);
        $init_row++;
        
        //Item	Oficina Destino		Acción	Oficina Origen		Fecha Movimiento		

        $objPHPExcel->getActiveSheet()->setCellValue('A'.$init_row, 'Item');
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$init_row, 'Oficina Destino');
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$init_row, 'Acción');
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$init_row, 'Oficina Origen');
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$init_row, 'Fecha Movimiento');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$init_row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$init_row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$init_row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$init_row)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$init_row)->getFont()->setBold(true);
        $init_row++;
        
        foreach($record->getRecordLogs() as $key => $log)
        {
          $init_row = $init_row + $key;
          
          $objPHPExcel->getActiveSheet()->setCellValue('A'.$init_row, $key+1);
          $objPHPExcel->getActiveSheet()->setCellValue('B'.$init_row, $log->getToArea()->getName());
          $objPHPExcel->getActiveSheet()->setCellValue('C'.$init_row, $log->getStatusStr());
          $objPHPExcel->getActiveSheet()->setCellValue('D'.$init_row, $log->getFromArea()->getName());
          $objPHPExcel->getActiveSheet()->setCellValue('E'.$init_row, $log->getDateTimeObject('created_at')->format('m/d/Y H:m:i'));
          
                   
        }          
        
     
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
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
        
      
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Content-Type: application/vnd.ms-excel.sheet.macroEnabled.12"); 
        header("Content-Disposition: inline; filename=reporte_por_expediente.xlsx");
                      
        $objWriter->save('php://output');
        
        throw new sfStopException();
    } 
}
