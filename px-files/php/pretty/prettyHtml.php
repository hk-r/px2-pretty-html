<?php

/**
 * HTML Validator
 */
namespace hk\pickles2\prettyHtml;

// require 'vendor/autoload.php';
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

        foreach( $px->bowl()->get_keys() as $key ){
            $src = $px->bowl()->pull( $key );

            $indenter = new Indenter();
            $after = $indenter->indent( $src );

            $px->bowl()->replace( $after, $key );
        }

        return true;
    }

}