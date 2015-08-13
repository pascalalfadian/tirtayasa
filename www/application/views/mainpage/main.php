<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<title>KIRI</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?= $this->lang->line('meta-description') ?>" />
<meta name="author" content="Project Kiri (KIRI)" />
<meta name="google-site-verification" content="9AtqvB-LWohGnboiTyhtZUXAEcOql9B-8lDjo_wcUew" />
<link rel="stylesheet" href="/ext/foundation/css/foundation.min.css" />
<link rel="stylesheet" href="/ext/openlayers/ol.css" />
<link rel="stylesheet" href="/stylesheets/styleIndex.css" />
<script src="/ext/foundation/js/vendor/modernizr.js"></script>
</head>
<body>
	<div class="row">
		<div id="controlpanel" class="large-3 large-push-9 columns">
			<div class="row center">
				<img src="/images/kiri200.png" alt="KIRI logo"/>
			</div>
			<div class="row">
				<div class="small-5 columns">
					<select id="regionselect">
					<?php foreach ($regions as $key => $value): ?>
						<option value="<?=$key?>"><?=$value['name']?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="small-7 columns">
					<select id="localeselect">
					<?php foreach ($languages as $key => $value): ?>
						<option value="<?=$key?>"><?=$value['name']?></option>
					<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="small-2 columns">
					<label for="startInput" class="inline"><?= $this->lang->line('From') ?>:</label>
				</div>
				<div class="small-10 columns">
					<input type="text" id="startInput" value=""	placeholder="<?=$this->lang->line('placeholder-from')?>">
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<select id="startSelect" class="hidden"></select>
				</div>
			</div>
			<div class="row">
				<div class="small-2 columns">
					<label for="finishInput" class="inline"><?=$this->lang->line('To')?>:</label>
				</div>
				<div class="small-10 columns">
					<input type="text" id="finishInput" value="" placeholder="<?=$this->lang->line('placeholder-to')?>">
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<select id="finishSelect" class="hidden"></select>
				</div>
			</div>
			<div class="row">
				<div class="small-6 columns">
					<a href="#" class="small button expand" id="findbutton"><strong>Find!</strong></a>
				</div>
				<div class="small-3 columns">
					<a href="#" class="small button secondary expand" id="swapbutton"><img src="images/swap.png" alt="swap"></a>
				</div>
				<div class="small-3 columns">
					<a href="#" class="small button secondary expand" id="resetbutton"><img src="images/reset.png" alt="reset"></a>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns" id="routingresults">
					<div id="results-section-container"></div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<footer>
						<a href="<?=$this->lang->line('url-apps')?>"><?=$this->lang->line('Mobile Apps')?></a> |
						<a href="<?=$this->lang->line('url-legal')?>"><?=$this->lang->line('Legal')?></a> | 
						<a href="<?=$this->lang->line('url-feedback')?>"><?=$this->lang->line('Feedback')?></a> | 
						<a href="<?=$this->lang->line('url-about')?>"><?=$this->lang->line('About KIRI')?></a>
					</footer>
					&nbsp;
				</div>
			</div>
			<div class="row">
								</div>
		</div>
		<div id="map" class="large-9 large-pull-3 columns"></div>
	</div>
	<script src="/ext/foundation/js/vendor/jquery.js"></script>
	<script src="/ext/foundation/js/vendor/fastclick.js"></script>
	<script src="/ext/foundation/js/foundation.min.js"></script>
	<script src="/ext/foundation/js/foundation/foundation.alert.js"></script>
	<script src="/ext/openlayers/ol.js"></script>
	<script>
		var input_text = [], coordinates = [];
		input_text['start'] = null;
		coordinates['start'] = null;
		input_text['finish'] = null;
		coordinates['finish'] = null;
		var locale='en';
		var region='bdo';
		var messageBuyTicket = 'BUY TICKET';
		var messageConnectionError = 'Connection problem';
		var messageFillBoth = 'Fill both "From" and "To"!';
		var messageNotFound = ' not found';
		var messageOops = 'Oops';
		var messageOrderTicketHere = 'order ticket';
		var messagePleaseWait = '<img src="images/loading.gif" alt="... "/> ' + 'Please wait...';
		var messageITake = 'I take public transport from %start% to %finish%!';
		var messageFixTracks = 'Route broken? Help fix it!';
		var messagePleaseTakeSurvey = 'Thanks to participate in quality survey #2 (3 minutes)';
		var region = 'bdo';
		var regions = {
			bdo: {center: '-6.91474,107.60981', zoom: 12},
			depok: {center: '-6.3878486,106.8177975', zoom: 13},
			cgk: {center: '-6.21154,106.84517', zoom: 11},
			sub: {center: '-7.27421,112.71908', zoom: 12},
			mlg: {center: '-7.9812985,112.6319264', zoom: 13}
		};
		$(document).foundation();
	</script>
	<script src="/mainpage/js/protocol.js"></script>
	<script src="/mainpage/js/main.js"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-36656575-2', 'kiri.travel');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');
	</script>
</body>
</html>