<?php
/**
 * Set font-color for a column
 * general or based on a value
 *
 */
namespace ZfcDatagrid\Column\Style;

class Color extends AbstractStyle
{

    public static $RED = array(
        255,
        0,
        0
    );

    public static $GREEN = array(
        0,
        255,
        0
    );

    public static $BLUE = array(
        0,
        0,
        255
    );

    protected $red;

    protected $green;

    protected $blue;

    /**
     * Set red green blue
     *
     * @param mixed $redOrStaticOrArray
     *            0-255
     * @param integer $green
     *            0-255
     * @param integer $blue
     *            0-255
     */
    public function __construct ($redOrStaticOrArray, $green = null, $blue = null)
    {
        if (is_array($redOrStaticOrArray) && count($redOrStaticOrArray) === 3) {
            list ($red, $green, $blue) = $redOrStaticOrArray;
        } else {
            $red = $redOrStaticOrArray;
        }
        
        $this->red = (int) $red;
        $this->green = (int) $green;
        $this->blue = (int) $blue;
    }

    /**
     * Set the RGB
     *
     * @param int $red
     *            0-255
     * @param int $green
     *            0-255
     * @param int $blue
     *            0-255
     * @return \ZfcDatagrid\Column\Style\Color
     */
    public function setRgb ($red, $green, $blue)
    {
        $this->red = (int) $red;
        $this->green = (int) $green;
        $this->blue = (int) $blue;
        
        return $this;
    }
    
    /**
     *
     * @param unknown $red            
     * @return \ZfcDatagrid\Column\Style\Color
     */
    public function setRed ($red)
    {
        $this->red = (int) $red;
        
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getRed ()
    {
        return $this->red;
    }

    /**
     *
     * @param unknown $green            
     * @return \ZfcDatagrid\Column\Style\Color
     */
    public function setGreen ($green)
    {
        $this->green = (int) $green;
        
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getGreen ()
    {
        return $this->green;
    }

    /**
     *
     * @param unknown $blue            
     * @return \ZfcDatagrid\Column\Style\Color
     */
    public function setBlue ($blue)
    {
        $this->blue = (int) $blue;
        
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getBlue ()
    {
        return $this->blue;
    }

    /**
     * 
     * @return array
     */
    public function getRgbArray(){
        return array('red' => $this->getRed(), 'green' => $this->getGreen(), 'blue' => $this->getBlue());
    }
    
    
    /**
     * Convert RGB dec to hex as a string
     *
     * @return string
     */
    public function getRgbHexString ()
    {
        $red = dechex($this->getRed());
        if (strlen($red) === 1) {
            $red = '0' . $red;
        }
        $green = dechex($this->getGreen());
        if (strlen($green) === 1) {
            $green = '0' . $green;
        }
        $blue = dechex($this->getBlue());
        if (strlen($blue) === 1) {
            $blue = '0' . $blue;
        }
        
        return $red . $green . $blue;
    }
}
