<?php
/**
 * 插件机制 Component
 */
class UPlugin extends CApplicationComponent {

	public $pluginDir = '';
	private $_listeners = array();

	/**
	 * 初始化
	*/
	public function init() {
		parent::init();
		$plugins = $this->getActivePlugs();

		if ($plugins && is_array($plugins)) {
			foreach ($plugins as $plugin) {
				$path = $this->pluginDir . $plugin['directory'] . '/' . ucfirst($plugin['directory']) . '.php';
				if (file_exists($path)) {
					require_once ($path);
					$class = ucfirst($plugin['directory']);
					if (class_exists($class)) {
						new $class($this);
					}
				}
			}
		}
	}

	/**
	 *  注册hook
	 * @param string $hook
	 * @param object $reference
	 * @param string $method
	 */
	public function register($hook, &$reference, $method) {
		$key = get_class($reference) . '->' . $method;
		$this->_listeners[$hook][$key] = array(&$reference, $method);
	}

	/**
	 * 执行 hook
	 * @param string $hook
	 */
	public function trigger($hook) {
		if ($this->checkHookExist($hook)) {
			foreach ($this->_listeners[$hook] as $listener) {
				$class = $listener[0];
				$method = $listener[1];
				if (method_exists($class, $method)) {
					$args = array_slice(func_get_args(), 1);
					call_user_func_array(array($class, $method), $args);
				}
			}
		}
	}

	/**
	 * 检查hook是否存在
	 * @param string $hook
	 * @return boolean
	 */
	public function checkHookExist($hook) {
		if (isset($this->_listeners[$hook]) && is_array($this->_listeners[$hook]) && count($this->_listeners[$hook])) {
			return TRUE;
		}
		return false;
	}

	/**
	 * 获取激活的插件
	 * @return array
	 */
	public function getActivePlugs() {
		$arr = array(
				'helloworld' => array(
						'name' => 'helloworld',
						'directory' => 'hello'
				),
		);
		return $arr;
	}

	/**
	 * 插件模板渲染
	 * @param string $pluginName
	 * @param string $templateName
	 * @param array $data
	 */
	public function render($pluginName, $templateName, $data = array()) {
		$template = new Template;
		$template->init($pluginName, $templateName, $data, $this->pluginDir);
		$template->outPut();
	}

}
?>