<?php

class QRCode
{
    const API_URL = 'https://chart.googleapis.com/chart?chs=';
    private $_sData;
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_sData = 'BEGIN:VCARD' . "\n";
        $this->_sData .= 'VERSION:4.0' . "\n";
        return $this;
    }

    public function data($sName)
    {
        $this->_sData =$sName;
        return $this;
    }
public function get($iSize = 150, $sECLevel = 'L', $iMargin = 1)
    {
        return self::API_URL . $iSize . 'x' . $iSize . '&cht=qr&chld=' . $sECLevel . '|' . $iMargin . '&chl=' . $this->_sData;
    }
  public function display()
    {
        echo '<p class="center" align= "center"><img src="' . $this->get() . '" alt="QR Code" style="width:300px;height:300px;" /></p>';
    }
}
?>
