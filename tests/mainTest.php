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
	 * OGP test
	 */
	public function testStandardPretty(){
		//

		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/sample_pages/training/index.html' ,// picklesのrootからのパス
		] );

		// $this->assertEquals( 1, preg_match('/'.preg_quote('<meta property="og:custome1" content="カスタム項目1" />','/').'/s', $output) );
		
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
