<?php
//����������� � ���� ������
include("includes/connection.php");
//������� ���������
function ftranslite($name){
    $name=preg_replace("/[\s+\.\,]/","-",$name);
    $name=preg_replace("/[\"\'!\?\(\)\:\$\%]/","",$name);
    static $trans=array(
    '�'=>'a', '�'=>'b', '�'=>'v', '�'=>'g', '�'=>'d', '�'=>'e', '�'=>'zh', '�'=>'z',
    '�'=>'i', '�'=>'y', '�'=>'k', '�'=>'l', '�'=>'m', '�'=>'n', '�'=>'o', '�'=>'p',
    '�'=>'r', '�'=>'s', '�'=>'t', '�'=>'u', '�'=>'f', '�'=>'i', '�'=>'e', '�'=>'A',
    '�'=>'B', '�'=>'V', '�'=>'G', '�'=>'D', '�'=>'E', '�'=>'ZH', '�'=>'Z', '�'=>'I',
    '�'=>'Y', '�'=>'K', '�'=>'L', '�'=>'M', '�'=>'N', '�'=>'O', '�'=>'P', '�'=>'R',
    '�'=>'S', '�'=>'T', '�'=>'U', '�'=>'F', '�'=>'I', '�'=>'E', '�'=>"yo", '�'=>"h",
    '�'=>"ts", '�'=>"ch", '�'=>"sh", '�'=>"shch", '�'=>"", '�'=>"", '�'=>"yu", '�'=>"ya",
    '�'=>"YO", '�'=>"H", '�'=>"TS", '�'=>"CH", '�'=>"SH", '�'=>"SHCH", '�'=>"", '�'=>"",
    '�'=>"YU", '�'=>"YA"                                 
    );
    $strstring = strtr($name, $trans);
    return strtolower($strstring);
}

function utf8_to_cp1251($s) 
  { 
  if ((mb_detect_encoding($s,'UTF-8,CP1251')) == "UTF-8") 
    { 
    for ($c=0;$c<strlen($s);$c++) 
      { 
      $i=ord($s[$c]); 
      if ($i<=127) $out.=$s[$c]; 
      if ($byte2) 
        { 
        $new_c2=($c1&3)*64+($i&63); 
        $new_c1=($c1>>2)&5; 
        $new_i=$new_c1*256+$new_c2; 
        if ($new_i==1025) 
          { 
          $out_i=168; 
          } else { 
          if ($new_i==1105) 
            { 
            $out_i=184; 
            } else { 
            $out_i=$new_i-848; 
            } 
          } 
        $out.=chr($out_i); 
        $byte2=false; 
        } 
        if (($i>>5)==6) 
          { 
          $c1=$i; 
          $byte2=true; 
          } 
      } 
    return $out; 
    } 
  else 
    { 
    return $s; 
    } 
  } 
?>