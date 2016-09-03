<?php
require_once './model/card/card.php';
require_once './model/card/spade.php';
require_once './model/card/heart.php';
require_once './model/card/diamond.php';
require_once './model/card/club.php';
require_once './model/hand/hand.php';
require_once './model/hand/straight_flush.php';
require_once './model/hand/four_of_a_kind.php';
require_once './model/hand/full_house.php';
require_once './model/hand/straight.php';
require_once './model/hand/flush.php';
require_once './model/hand/three_of_a_kind.php';
require_once './model/hand/two_pair.php';
require_once './model/hand/one_pair.php';
require_once './model/hand/high_cards.php';

// 送信されたJSONデータに含まれる各カード情報を取得
$input_json = file_get_contents('php://input');
$input_array = json_decode($input_json, true);
$card_information_array = isset($input_array["cards"]) ? $input_array["cards"] : null;

// 各カード情報に該当する役を取得
$hand_array = array();
$best_hand_index = null;
$best_hand_priority = 99;
foreach ($card_information_array as $card_information) {
	// 入力値からカードデータを生成
	$card_array = array();
	$card_symbol_array = explode(" ", $card_information);
	foreach ($card_symbol_array as $card_symbol) {
		$card = Card::create($card_symbol);
		if (!is_null($card)) {
			$card_array[] = $card;
		}
	}

	// カードに該当する役を取得
	$hand = Hand::find($card_array);
	if (!is_null($hand)) {
		$hand_array[$card_information] = $hand;

		// 優先度が高い場合は記憶
		$priority = $hand->getPriority();
		if ($priority < $best_hand_priority) {
			$best_hand_index = $card_information;
			$best_hand_priority = $priority;
		}
	}
}

// クライアントに返すJSONデータを生成
$result_array = array();
foreach ($hand_array as $card_information => $hand) {
	$is_best = ($card_information == $best_hand_index);
	$result = array();
	$result["card"] = $card_information;
	$result["hand"] = $hand->getName();
	if ($is_best) {
		$result["best"] = true;
	}
	$result_array[] = $result;
}
$output_array = array("result" => $result_array);
$output_json = json_encode($output_array, JSON_UNESCAPED_UNICODE);

// JSONデータを出力
header("Content-Type: text/javascript; charset=utf-8");
echo $output_json;

