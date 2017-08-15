<?php

date_default_timezone_set('Asia/Tokyo');
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Gherkin\Node\StepNode;

/**
 * Defines application features from the specific context.
 */
#class FeatureContext extends Behatch\Context\BaseContext
class FeatureContext extends \Behat\MinkExtension\Context\RawMinkContext implements Context {
	private $screenshotDir;

	/**
	 * Initializes context.
	 *
	 * Every scenario gets its own context instance.
	 * You can also pass arbitrary arguments to the
	 * context constructor through behat.yml.
	 *
	 * @param string $screenshotDir
	 */
	public function __construct( $screenshotDir = '.' ) {
		$this->screenshotDir = $screenshotDir;
	}

	/**
	 * Copy from vendor/behatch/contexts/src/Context/DebugContext.php:46
	 * テスト実行時にスクリーンショットを撮影する
	 * behatchのDebugContextはテストが失敗した時、かつ@javascriptタグがフィーチャーに付いている時のみ動作する。
	 *   (Driverの実装によってはsession->driver->getScreenshot()が動作しない)
	 * ファイル名を決定する際にシナリオ名をurl_encodeしているため、ファイル名が長くてfile_put_contentsに失敗する。
	 *
	 *
	 * @AfterStep
	 *
	 * @param AfterStepScope $scope
	 */
	public function saveScreenshotsAfterStep(AfterStepScope $scope)
	{
		#if (! $scope->getTestResult()->isPassed()) {
		#$makeScreenshot = false;
		$suiteName      = str_replace(' ', '_', $scope->getSuite()->getName());
		$featureName    = str_replace(' ', '_', $scope->getFeature()->getTitle());
		if ($this->getBackground($scope)) {
			#$makeScreenshot = $scope->getFeature()->hasTag('javascript');
			$scenarioName   = 'background';
			$stepLine       = 0;
		} else {
			$scenario       = $this->getScenario($scope);
			#$makeScreenshot = $scope->getFeature()->hasTag('javascript') || $scenario->hasTag('javascript');
			$scenarioName   = str_replace(' ', '_', $scenario->getTitle());
			$stepLine       = $scope->getStep()->getLine();
		}
		#if ($makeScreenshot) {
		$isPassed = $scope->getTestResult()->isPassed() ? "pass" : "fail";
		$filename = sprintf( '%s_%s_%s_%s_%s_%s.png', $isPassed, round( microtime( true ) * 1000 ), $suiteName, $featureName, $scenarioName, $stepLine );
		$this->saveScreenshot( $filename, $this->screenshotDir );
		#}
		#}
	}

	/**
	 * StepからScenarioを直接辿れない構造になっているため
	 * StepからFeatureを取得してScenario一覧を取得して
	 * 一覧をforeachで回して実行中のStepの行番号に該当するScenarioを取得するメソッドっぽい。カオス。
	 * @param AfterStepScope $scope
	 * @return \Behat\Gherkin\Node\ScenarioInterface
	 */
	private function getScenario(AfterStepScope $scope)
	{
		$scenarios = $scope->getFeature()->getScenarios();
		foreach ($scenarios as $scenario) {
			$stepLinesInScenario = array_map(
				function (StepNode $step) {
					return $step->getLine();
				},
				$scenario->getSteps()
			);
			if (in_array($scope->getStep()->getLine(), $stepLinesInScenario)) {
				return $scenario;
			}
		}

		throw new \LogicException('Unable to find the scenario');
	}

	/**
	 * @param AfterStepScope $scope
	 * @return \Behat\Gherkin\Node\BackgroundNode
	 */
	private function getBackground(AfterStepScope $scope)
	{
		$background = $scope->getFeature()->getBackground();
		if(!$background){
			return false;
		}
		$stepLinesInBackground = array_map(
			function (StepNode $step) {
				return $step->getLine();
			},
			$background->getSteps()
		);
		if (in_array($scope->getStep()->getLine(), $stepLinesInBackground)) {
			return $background;
		}

		return false;
	}



	/**
	 * https://stackoverflow.com/questions/27153971/make-css-selector-first-child-work-in-behat-3-with-sahi-driver
	 * @When /^(?:|I )click (?:|on )(?:|the )"([^"]*)"(?:|.*)$/
	 */
//	public function iClickOn($arg1)
//	{
//		$findName = $this->getSession()->getPage()->find("css", $arg1);
//		if (!$findName) {
//			throw new Exception($arg1 . " could not be found");
//		} else {
//			$findName->click();
//		}
//	}
}
