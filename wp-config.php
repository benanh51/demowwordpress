<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'demo' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'p% q-hu>MF$kn]BWa=+m@F~SKoj~%DtMEE+HcCVQ FyyjOB7DO}[A~fH^hlbCCCM' );
define( 'SECURE_AUTH_KEY',  'o,{FuYivVufUH77VUY&)VG!Ih~?Jw9=JEjuj[ma,U=ng]r[z4M_7FcwK;P?)eI#J' );
define( 'LOGGED_IN_KEY',    'c5(~%zL;.UvCsUw,n1{+|:9elB-CFzO)3pY/ >l6%I.HqkjF2kH:@.!oJz^&NqMA' );
define( 'NONCE_KEY',        'ac_%W7TTW.|v4VF&@ecAfkIaE3h>Os$>X1kg5<Fxm:0hE$/}RRnfJGAw0S{UY`<Z' );
define( 'AUTH_SALT',        ' DoTL%-*je,KWx5+Lh8HxUQ^7+;v2^[<AZG!P/pIe]A5Zx5w r:</l{h2J%)EjQ+' );
define( 'SECURE_AUTH_SALT', 'egM*carymJ8bdIb`.C|F~@|#&m1~xyx?)/`]9;*61Dp)!u$Rhgd#q@#K]F`wx370' );
define( 'LOGGED_IN_SALT',   '2rvb*U$TDI5lmXy@1<4:4o3%Sl6n68B{&oGq!hJY(Jq1@gsssG<S;>rc4Z1Xw21g' );
define( 'NONCE_SALT',       'ITk7w_k/11]3ve{.!yq:fuU4y:>NXNmwW6._vy+DOw=05X]m[cpqUkUHE3dR~(44' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
