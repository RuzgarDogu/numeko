<?php
class Pdfmake
{

    public static function generateHTML($p)
    {
      return "
      <div id='capture' style='width:841.89px; height: 595.28px; padding: 30px; background: #fff'>
          <h4 style='color: #000; '>{$p}</h4>
          <p>Buraya da başka şeyler gelecek</p>

      </div>
        ";
    }

}
