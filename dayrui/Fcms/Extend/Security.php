<?php namespace Phpcmf\Extend;
/**
 * www.xunruicms.com
 * 迅睿内容管理框架系统（简称：迅睿CMS）
 * 本文件是框架系统文件，二次开发时不可以修改本文件
 **/


/**
 * 用于Services.php
 */

use CodeIgniter\HTTP\RequestInterface;
use Config\App;

class Security extends \CodeIgniter\Security\Security {

    /**
     * CSRF Verify
     *
     * @param RequestInterface $request
     *
     * @return $this|false
     * @throws \Exception
     */
    public function verify(RequestInterface $request)
    {

        // 过滤白名单内的控制器
        if (in_array(\Phpcmf\Service::L('router')->uri(), \Phpcmf\Service::Filters())) {
            return $this;
        }

        // Protects POST, PUT, DELETE, PATCH
        $method = strtoupper($request->getMethod());
        $methodsToProtect = ['POST', 'PUT', 'DELETE', 'PATCH'];
        if (! in_array($method, $methodsToProtect, true)) {
            return $this;
        }

        // Does the token exist in POST, HEADER or optionally php:://input - json data.
        if ($request->hasHeader($this->headerName) && ! empty($request->header($this->headerName)->getValue())) {
            $tokenName = $request->header($this->headerName)->getValue();
        } else {
            $code = $request->getBody();
            $json = json_decode($code ? $code : '');
            if (! empty($request->getBody()) && ! empty($json) && json_last_error() === JSON_ERROR_NONE) {
                $tokenName = $json->{$this->tokenName} ?? null;
            } else {
                $tokenName = null;
            }
        }

        $token = $request->getPost($this->tokenName) ?? $tokenName;

        // Do the tokens match?
        if (! isset($token, $this->hash) || ! hash_equals($this->hash, $token)) {
            CI_DEBUG && log_message('debug', '跨站验证拦截（'.$this->hash.' / '.$token.'）');
            dr_exit_msg(0, '跨站验证超时请重试', '', [
                'name' => $this->tokenName,
                'value' => $this->hash
            ]);
        }

        if (isset($_POST[$this->tokenName])) {
            // We kill this since we're done and we don't want to pollute the POST array.
            unset($_POST[$this->tokenName]);
            $request->setGlobal('post', $_POST);
        }

        if (defined('SYS_CSRF_TIME') && SYS_CSRF_TIME) {
            $this->hash = null;
            if ($this->csrfProtection === self::CSRF_PROTECTION_COOKIE) {
                unset($_COOKIE[$this->cookieName]);
            } else {
                // Session based CSRF protection
                Services::session()->remove($this->tokenName);
            }
        }

        $this->generateHash();

        return $this;
    }

}