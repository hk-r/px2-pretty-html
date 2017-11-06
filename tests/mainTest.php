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

		// オプション指定してないエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote('<h2>ここはh2です</h2>','/').'/s', $output) );

		// オプション(exclusion_elements)で指定したエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote('<h1>','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('ここはh1です','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('</h1>','/').'/s', $output) );

		// オプション(inline_elements)で指定したエレメントの出力確認
		$this->assertEquals( 1, preg_match('/'.preg_quote('supの確認（例：cm<sup>2</sup>）です。','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('<li><span>編集してみょう</span></li>','/').'/s', $output) );
		
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
