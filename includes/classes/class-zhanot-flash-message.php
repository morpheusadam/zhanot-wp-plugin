<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ZHANOT_Flash_Message {

	/**
	 * Message
	 * @var
	 */
	protected $_messages;

	/**
	 * Alert types
	 */
	const ERROR = 1;
	const SUCCESS = 2;
	const WARNING = 3;
	const INFO = 4;

	/**
	 * Save error
	 * @var
	 */
	public static $has_error;

	/**
	 * Add message to session array
	 *
	 * @param string $message
	 * @param int $type
	 */
	public static function add_message( $message = "", $type = self::SUCCESS ) {
		if ( ! isset( $_SESSION['zhanot']['messages'] ) ) {
			$_SESSION['zhanot']['messages'] = array();
		}
		if ( $type == self::ERROR ) {
			self::$has_error = true;
		}
		$_SESSION['zhanot']['messages'][] = array(
			'body' => $message,
			'type' => $type
		);
	}

	/**
	 * Show message
	 */
	public static function show_message() {
		if ( isset( $_SESSION['zhanot']['messages'] ) && ! empty( $_SESSION['zhanot']['messages'] ) ) {
			foreach ( $_SESSION['zhanot']['messages'] as $message ) {
				$alert_class = self::get_alert_type( $message['type'] )
				?>
                <div class="<?php echo is_admin() ? 'notice is-dismissible' : 'zhanot-alert'; ?> <?php echo $alert_class; ?>">
                    <p><?php echo $message['body']; ?></p>
                </div>
				<?php
			}
			self::empty_bag();
		}
	}

	/**
	 * Get alert type
	 *
	 * @param $type
	 *
	 * @return string
	 */
	public static function get_alert_type( $type ) {
		switch ( $type ) {
			case self::SUCCESS:
				if ( is_admin() ) {
					return 'notice-success';
				} else {
					return 'zhanot-alert-success';
				}
				break;
			case self::ERROR:
				if ( is_admin() ) {
					return 'notice-error';
				} else {
					return 'zhanot-alert-danger';
				}
				break;
			case self::WARNING;
				if ( is_admin() ) {
					return 'notice-warning';
				} else {
					return 'zhanot-alert-warning';
				}
				break;
			case self::INFO:
				if ( is_admin() ) {
					return 'notice-info';
				} else {
					return 'zhanot-alert-info';
				}
				break;

		}
	}

	/**
	 * Make session and $has_error variable empty for next use
	 */
	public static function empty_bag() {
		$_SESSION['zhanot']['messages'] = array();

		self::$has_error = false;
	}
}