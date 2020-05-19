<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainpage extends CI_Controller {
	public function index() {
		if ($this->input->get('utm_campaign') !== 'prefer_old') {
			http_response_code(301);
			$get = $this->input->get();
			$get['utm_source'] = 'kiri.travel';
			$get['utm_campaign'] = 'newhome';
			header('Location: https://projectkiri.id?' . http_build_query($get));
			exit();
		}
		$this->load->config('tirtayasa');

		// Setup locale
		if (is_null($this->input->get('locale'))) {
			$locale = $this->_getValidatedLocale($this->input->cookie('locale'));
		} else {
			$locale = $this->_getValidatedLocale($this->input->get('locale'));
			$this->input->set_cookie('locale', $locale, time() + 3600 * 24 * 365);
		}
		$this->lang->load('tirtayasa', $this->config->item('languages')[$locale]['file']);
		
		// Setup region
		if (is_null($this->input->get('region'))) {
			$region = $this->_getValidatedRegion($this->input->cookie('region'));
		} else {
			$region = $this->_getValidatedRegion($this->input->get('region'));
			$this->input->set_cookie('region', $region, time() + 3600 * 24 * 365);
		}

		// Setup Youtube code
		$youtube_code = $this->input->get('yt');
		$youtube_label = null;
		if (!is_null($youtube_code) && !array_key_exists($youtube_code, $this->lang->line('label-youtube'))) {
			$youtube_code = 'default';
			$youtube_label = $this->lang->line('label-youtube')[$youtube_code];
		}

		// Setup start/finish autofill
		$endpoint = array(
			'start' => $this->input->get('start'),
			'finish' => $this->input->get('finish')
		);
		foreach (array('start', 'finish') as $endpoint) {
			$startfinish = $this->input->get($endpoint);
			if (!is_null($startfinish)) {
				if (preg_match('/^(.+)\\/(-?[0-9.]+,-?[0-9.]+)$/', $startfinish, $matches)) {
					$textual_endpoint [$endpoint] = $matches[1];
					$coordinate_endpoint [$endpoint] = $matches[2];
				} else {
					$textual_endpoint [$endpoint] = $startfinish;
					$coordinate_endpoint [$endpoint] = null;
				}
			} else {
				$textual_endpoint [$endpoint] = null;
				$coordinate_endpoint [$endpoint] = null;
			}
		}

		$data = array(
			'regions' => $this->config->item('regions'),
			'region' => $region,
			'languages' => $this->config->item('languages'),
			'locale' => $locale,
			'youtube' => is_null($youtube_code) ? null : array('code' => $youtube_code, 'label' => $youtube_label),
			'inputText' => array('start' => $textual_endpoint['start'], 'finish' => $textual_endpoint['finish']),
			'inputCoordinate' => array('start' => $coordinate_endpoint['start'], 'finish' => $coordinate_endpoint['finish'])
		);
		$this->load->view('mainpage/main', $data);
	}

	public function js($name) {
		$this->load->config('tirtayasa');
		$locale = $this->_getValidatedLocale($this->input->get('locale'));
		$this->lang->load('tirtayasa', $this->config->item('languages')[$locale]['file']);
		switch ($name) {
			case 'main.js':
				$this->load->view('mainpage/main.js', array('locale' => $locale));
				break;
			case 'protocol.js':
				$this->load->view('mainpage/protocol.js');
				break;
			default:
				show_404();
		}
	}

	private function _getValidatedLocale($locale) {
		if (is_null($locale) || !isset($this->config->item('languages')[$locale])) {
			$locale = 'en';
		}
		return $locale;		
	}

	private function _getValidatedRegion($region) {
		if (is_null($region) || !isset($this->config->item('regions')[$region])) {
			$region = 'bdo';
		}
		return $region;		
	}

}
