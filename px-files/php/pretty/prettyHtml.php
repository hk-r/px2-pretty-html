<?php

/**
 * HTML Validator
 */
namespace hk\pickles2\prettyHtml;

use \Gajus\Dindent\Indenter;

/**
 * processor "extract" class
 */
class prettyHtml{

    /**
     * 変換処理の実行
     * @param object $px Picklesオブジェクト
     */
    public static function exec( $px, $json ){

        $arg_array = array();
        $param_array = array();

        foreach( $px->bowl()->get_keys() as $key ){
            $src = $px->bowl()->pull( $key );

            if ( $arg_array = (array)$json ) {
                if ( array_key_exists('indentation_character', $arg_array) ) {
                    $param_array['indentation_character'] = $arg_array['indentation_character'];
                } else {
                    $param_array['indentation_character'] = '  '; // 半角スペース2つ
                }
            }

            $indenter = new Indenter( $param_array );
            $after = $indenter->indent( $src );

            $px->bowl()->replace( $after, $key );
        }

        return true;
    }

}