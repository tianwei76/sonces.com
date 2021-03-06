<?php namespace Config;
/**
 * www.xunruicms.com
 * 迅睿内容管理框架系统（简称：迅睿CMS）
 * 本文件是框架系统文件，二次开发时不可以修改本文件
 **/

use CodeIgniter\Config\BaseConfig;

/**
 * Setup how the exception handler works.
 */
class Exceptions extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * LOG EXCEPTIONS?
     * --------------------------------------------------------------------------
     * If true, then exceptions will be logged
     * through Services::Log.
     *
     * Default: true
     *
     * @var boolean
     */
    public $log = true;

    /**
     * --------------------------------------------------------------------------
     * DO NOT LOG STATUS CODES
     * --------------------------------------------------------------------------
     * Any status codes here will NOT be logged if logging is turned on.
     * By default, only 404 (Page Not Found) exceptions are ignored.
     *
     * @var array
     */
    public $ignoreCodes = [404];

    /**
     * --------------------------------------------------------------------------
     * Error Views Path
     * --------------------------------------------------------------------------
     * This is the path to the directory that contains the 'cli' and 'html'
     * directories that hold the views used to generate errors.
     *
     * Default: APPPATH.'Views/errors'
     *
     * @var string
     */
    public $errorViewPath = COREPATH . 'View/errors';
	
	/**
	 * --------------------------------------------------------------------------
	 * HIDE FROM DEBUG TRACE
	 * --------------------------------------------------------------------------
	 * Any data that you would like to hide from the debug trace.
	 * In order to specify 2 levels, use "/" to separate.
	 * ex. ['server', 'setup/password', 'secret_token']
	 *
	 * @var array
	 */
	public $sensitiveDataInTrace = [];
}
