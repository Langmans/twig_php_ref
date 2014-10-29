<?php
class Twig_Extension_Ref_Debug_Replacement extends Twig_Extension_Ref{

    function getName()
    {
        return 'php-ref-debug';
    }

    public function getFunctions()
    {
        return array(
            $this->_getFunction('dumpFunction')
        );
    }
}
