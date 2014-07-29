<?php

class PDF extends FPDF
{
    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco

        $this->CellFitSpace(15,7, utf8_decode("FOLIO"),1, 0 , 'C', true);
        $this->CellFitSpace(225,7, utf8_decode("CONCEPTO"),1, 0 , 'C', true);
        $this->CellFitSpace(20,7, utf8_decode("IMPORTE"),1, 0 , 'C', true);
        
        foreach($cabecera as $fila)
        {   //Atención!! el parámetro true rellena la celda con el color elegido
            //$this->Cell(20,7, utf8_decode($fila),1, 0 , 'C', true);
        }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,77);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        $suma=0;
        $yMayor = 0;
        foreach($datos as $fila)
        {
            $suma=$fila->cant_cobrar+$suma;
            //Save the current position 
            $x=$this->GetX(); 
            $y1=$this->GetY();

            //El parámetro badera dentro de Cell: true o false
            //true: Llena  la celda con el fondo elegido
            //false: No rellena la celda
            $this->MultiCell(15,10,utf8_decode($fila->st_folio),1,'C',$bandera);
            $this->SetXY($x+15,$y1);
            $this->MultiCell(225,5,utf8_decode($fila->tra_nombre."."),1,'J',$bandera);
            //$this->Cell(170);
            $this->SetXY($x+240,$y1);
            $this->MultiCell(20,10,utf8_decode($fila->cant_cobrar),1,'J', $bandera);

            //$this->Ln(7);//Salto de línea para generar otra fila
            //Put the position to the right of the cell       
			
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
        //Parte de código que permite obtener el concentrado total de la cantidad a cobrar e imprime los
        //Resulados en número y letra.
        $this->Ln(10);
        $total_letra=convertir($suma);//Convierte la cantidad del concentrado total a letra
        $this->SetFont('Arial','B',11);
        $this->Cell(46, 5,utf8_decode('CONCENTRADO TOTAL: '), 0,0,'J');
        $this->SetFont('Arial','',10);
        $this->Cell(1);        
        $this->MultiCell(140,5,utf8_decode("$".$suma.".00"." (".$total_letra.")"),0,'L',0);
    }

    function seleccionar_datos()
    {
        include ("../../conexion.php");
        $sql="SELECT s.st_folio,s.cant_cobrar,s.descuento, c.tra_nombre,s.st_fecha FROM solicitudtramite as s 
        inner join conceptos as c where s.concepto_tra_cve=c.tra_id and s.edo_reg='AUTORIZA' 
        AND s.st_fecha >= STR_TO_DATE('2013-11-05','%Y-%m-%d') and s.st_fecha 
        <= STR_TO_DATE('2014-11-05','%Y-%m-%d') order by(s.st_fecha)"; 
        $result = mysql_query($sql);
        //Array asociativo que contendrá los datos
        $valores = array();
        if(mysql_num_rows($result)==0)
        {
            echo'<script type="text/javascript">
                alert("ningun registro");
                </script>';
        } 
        else{
            while ($row =mysql_fetch_object($result))
            {
                //echo "Folio: ".$rsST['st_folio'];
                //echo "R ".$result;
                //Se crea un arreglo asociativo
                //echo $row->st_folio;
               array_push($valores, $row);
            }        
        }
        //Regresa array asociativo
        return $valores;
    }
 
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,"Usuario: ".$_SESSION["uario"].". ".utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
   }

   //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
//************** Fin del código para ajustar texto *****************
//******************************************************************
 
} // FIN Class PDF
?>