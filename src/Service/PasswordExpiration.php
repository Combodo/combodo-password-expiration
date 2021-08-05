<?php
namespace Combodo\iTop\Extension\Service;

use AbstractLoginFSMExtension;
use LoginWebPage;
use utils;

class PasswordExpiration extends AbstractLoginFSMExtension
{
	public function ListSupportedLoginModes()
	{
		return ['after'];
	}

	/**
	 * @param int $iErrorCode (see LoginWebPage::EXIT_CODE_...)
	 *
	 * @return int LoginWebPage::LOGIN_FSM_RETURN_ERROR, LoginWebPage::LOGIN_FSM_RETURN_OK or LoginWebPage::LOGIN_FSM_RETURN_IGNORE
	 */
	protected function OnCredentialsOK(&$iErrorCode)
	{
		return parent::OnCredentialsOK($iErrorCode);
		// Hard coded force change password
		$sUrl = utils::GetAbsoluteUrlAppRoot().'/pages/UI.php?loginop=change_pwd';
		header('Location: '.$sUrl);
		exit;
		
		// Hard-coded login denial !
		$iErrorCode = LoginWebPage::EXIT_CODE_WRONGCREDENTIALS;
		return LoginWebPage::LOGIN_FSM_ERROR;
	}
}