<?php
/**
 * Test for hk-r/px2-pretty-html
 *
 * $ cd (project dir)
 * $ composer test
 */
class mainTest extends PHPUnit_Framework_TestCase{

	/**
	 * setup
	 */
	public function setup(){
	}

	/**
	 * Pretty test
	 */
	public function testStandardPretty(){
		//

		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/sample_pages/training/index.html' ,// picklesのrootからのパス
		] );

		$pre 	  = file_get_contents(__DIR__ . '/output/pre.html');
		$textarea = file_get_contents(__DIR__ . '/output/textarea.html');
		$sup 	  = file_get_contents(__DIR__ . '/output/sup.html');
		$h1 	  = file_get_contents(__DIR__ . '/output/h1.html');
		$li 	  = file_get_contents(__DIR__ . '/output/li.html');


		// オプション指定してないエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote($h1,'/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote($li,'/').'/s', $output) );

		// オプション(exclusion_elements)で指定したエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote($pre,'/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote($textarea,'/').'/s', $output) );

		// オプション(inline_elements)で指定したエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote($sup,'/').'/s', $output) );
		
		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/?PX=clearcache' ,
		] );
	}//testStandardPretty()

	/**
	 * コマンドを実行
	 * @param array $ary_command
	 * @return string
	 */
	private function passthru( $ary_command ){
		$cmd = array();
		foreach( $ary_command as $row ){

			$param = '"'.addslashes($row).'"';
			array_push( $cmd, $param );
		}
		$cmd = implode( ' ', $cmd );

		ob_start();
		passthru( $cmd );
		$bin = ob_get_clean();

		return $bin;
	}// passthru()
}
