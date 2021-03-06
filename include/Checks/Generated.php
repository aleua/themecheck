<?php
namespace ThemeCheck;

class Generated_Checker extends CheckPart
{	
	public function doCheck($php_files, $php_files_filtered, $css_files, $other_files, $themeInfo)
    {
        $this->errorLevel = ERRORLEVEL_SUCCESS;
        // combine all the php files into one string to make it easier to search
        $php = implode( ' ', $php_files );
        
		foreach ( $this->code as $key )
		{
			if (strpos( $php, $key ) !== false)
			{
				$this->messages[] = __all('This theme appears to have been auto-generated.');
				$this->errorLevel = $this->threatLevel;
				break;
			}
		}
    }
}

class Generated extends Check
{	
    protected function createChecks()
    {
			$this->title = __all("generated theme");
			$this->checks = array(
						// error level is ERRORLEVEL_INFO is different from themecheck plugin because we dont specifically aim at validating for wordpress themes directory.
						new Generated_Checker('GENERATED_ARTISTEER', TT_COMMON, ERRORLEVEL_INFO, __all("Autogenerated Artisteer theme"), array (
																															"art_normalize_widget_style_tokens",
																															"art_include_lib",
																															'_remove_last_slash($url) {',
																															"adi_normalize_widget_style_tokens",
																															"m_normalize_widget_style_tokens",
																															"bw = '<!--- BEGIN Widget --->';",
																															"ew = '<!-- end_widget -->';",
																															"end_widget' => '<!-- end_widget -->'"), 'ut_generated_artister.zip'),
						new Generated_Checker('GENERATED_LUBITH', TT_COMMON, ERRORLEVEL_INFO, __all("Autogenerated Lubith theme"), array ( "Lubith") , 'ut_generated_lubith.zip'),
						new Generated_Checker('GENERATED_TEMPLATETOASTER', TT_COMMON, ERRORLEVEL_INFO, __all("Autogenerated Template Toaster theme"), array (
																															"templatetoaster_",
																															"Templatetoaster_",
																															"@package templatetoaster"), 'ut_generated_templatetoaster.zip'),
						new Generated_Checker('GENERATED_WPTHEMEGENERATOR', TT_COMMON, ERRORLEVEL_INFO, __all("Autogenerated WordPress Theme Generator theme"), array ( "wptg_") , 'ut_generated_wpthemegenerator.zip'),																											
			);
    }
}