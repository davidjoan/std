<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecordListPDF
 *
 * @author dtataje
 */
class RecordListPDF extends FPDF {
    
  public $username;
  public $B;
  public $I;
  public $U;
  public $HREF;

  function RecordListPDF($orientation='P', $unit='mm', $size='A4',$username='Desconocido')
  {
    //Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$size);
    //Iniciación de variables
    $this->B = 0;
    $this->I = 0;
    $this->U = 0;
    $this->HREF = '';
    $this->username = $username;
  }

  function Header()
  {
    $this->SetFont('Arial','B',15);
    $this->Cell(75);
    $titulo = 'Listado de Expedientes';
    $this->Cell(120,10,utf8_decode($titulo),1,0,'C');

    $this->SetFont('Arial','B',12);
    $this->Cell(25);
    $this->Cell(30,5,'usuario',1,0,'C');
    $this->Ln();
    $this->Cell(220);
    $this->Cell(30,5,$this->username,1,0,'C');
    $this->Ln(8);
    $this->Cell(220);
    $this->Cell(30,5,'Fecha',1,0,'C');
    $this->Ln();
    $this->SetFont('Arial','I',12);
    $this->Cell(220);
    $this->Cell(30,5,date('d/m/Y'),1,0,'C');
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $footer = 'SERING S.A.C. - Página ';
    $this->Cell(0,10,utf8_decode($footer).$this->PageNo(),0,0,'C');
  }


  function FancyTable($header, $data)
  {
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(70,130,180);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(149, 20, 20);
    for($i=0;$i<count($header);$i++)
    {
      $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    }
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
  }
  
  
  

  

  function OpenTag($tag, $attr)
  {
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
  }

  function CloseTag($tag)
  {
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
  }

  function SetStyle($tag, $enable)
  {
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
  }

  function PutLink($URL, $txt)
  {
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
  
function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
  } 
}
