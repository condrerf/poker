<?php
require_once '../model/card/card.php';
require_once '../model/card/spade.php';
require_once '../model/card/heart.php';
require_once '../model/card/diamond.php';
require_once '../model/card/club.php';
require_once '../model/hand/hand.php';
require_once '../model/hand/straight_flush.php';
require_once '../model/hand/four_of_a_kind.php';
require_once '../model/hand/full_house.php';
require_once '../model/hand/straight.php';
require_once '../model/hand/flush.php';
require_once '../model/hand/three_of_a_kind.php';
require_once '../model/hand/two_pair.php';
require_once '../model/hand/one_pair.php';
require_once '../model/hand/high_cards.php';

// 入力値からカードデータを生成
$card_array = array();
$card_information = isset($_REQUEST["card_information"]) ? $_REQUEST["card_information"] : null;
$card_symbol_array = explode(" ", $card_information);
foreach ($card_symbol_array as $card_symbol) {
	$card = Card::create($card_symbol);
	if (!is_null($card)) {
		$card_array[] = $card;
	}
}

// カードに該当する役を取得
$hand = Hand::find($card_array);
$hand_name = is_null($hand) ? null : $hand->getName();

include_once '../view/result.html';

