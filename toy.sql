-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 07, 2023 lúc 04:26 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `toy`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `address` varchar(170) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `address`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `amount`
--

CREATE TABLE `amount` (
  `product_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `sale_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `sale_quantity` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `amount`
--

INSERT INTO `amount` (`product_id`, `product_price`, `sale_price`, `product_quantity`, `sale_quantity`, `start_date`, `end_date`) VALUES
(102, 666666, 9905, 86, 6, '2023-12-07 15:00:58', '2023-12-14 17:00:00'),
(103, 1499000, 0, 46, 0, '2023-12-07 14:47:01', '2023-11-26 08:20:13'),
(104, 1699000, 0, 47, 0, '2023-12-07 14:48:02', '2023-11-26 08:21:08'),
(105, 899000, 0, 49, 0, '2023-12-01 05:58:34', '2023-11-26 08:22:01'),
(106, 799000, 0, 52, 0, '2023-12-07 14:08:02', '2023-11-26 08:23:37'),
(107, 1399000, 0, 100, 0, '2023-12-07 13:59:14', '2023-11-26 08:27:25'),
(108, 1699000, 0, 100, 0, '2023-12-07 13:55:54', '2023-11-26 08:28:18'),
(109, 69900, 0, 997, 0, '2023-12-01 06:05:47', '2023-11-26 08:31:26'),
(110, 1099000, 0, 998, 0, '2023-12-01 05:59:31', '2023-11-26 08:32:30'),
(111, 699000, 0, 54, 0, '2023-12-01 05:59:43', '2023-11-26 09:55:57'),
(114, 699000, 0, 53, 0, '2023-12-01 06:05:47', '2023-11-26 09:57:17'),
(115, 699000, 0, 55, 0, '2023-11-26 09:57:35', '2023-11-26 09:57:35'),
(119, 699000, 0, 54, 0, '2023-12-01 06:05:47', '2023-11-26 10:02:15'),
(120, 6990000, 0, 4, 0, '2023-12-01 06:05:47', '2023-11-26 10:18:10'),
(122, 8990000, 0, 3, 0, '2023-12-01 06:05:47', '2023-11-26 10:19:57'),
(123, 4990000, 0, 5, 0, '2023-11-26 10:21:30', '2023-11-26 10:21:30'),
(124, 4990000, 0, 4, 0, '2023-12-01 06:05:47', '2023-11-26 10:22:10'),
(126, 23331, 0, 21, 0, '2023-12-01 06:05:47', '2023-11-29 11:37:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `buy_code` varchar(50) NOT NULL,
  `vnpay_code` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `buyad` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `receive_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `buy`
--

INSERT INTO `buy` (`id`, `buy_code`, `vnpay_code`, `user_name`, `product_name`, `price`, `quantity`, `amount`, `payment`, `status`, `buyad`, `photo`, `add_date`, `receive_date`) VALUES
(1, '160494894', '', '1', 'Đồ Chơi Valvarad Draw Buckle', 799000, 2, '1598000', 'Thanh toán trực tiếp', 'Đã xác nhận', '<ul><li>trung nguyen1</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công;từ hội trường thôn thái công bắc đi thẳng vào 200m , dừng ở chỗ sân to bên phải đường</li></ul>', 'valvaar holder.png', '2023-12-01 06:09:24', '2023-11-30 18:00:01'),
(2, '871021371', '', '1', 'Mô Hình SHFiguart Ultraman Blazar', 1399000, 2, '2798000', 'Thanh toán trực tiếp', 'Đã xác nhận', '<ul><li>trung nguyen1</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công;từ hội trường thôn thái công bắc đi thẳng vào 200m , dừng ở chỗ sân to bên phải đường</li></ul>', 'Bản sao của chemy spanner.png', '2023-12-01 06:09:50', '2023-11-30 18:00:01'),
(3, '933879092', '', '1', 'Đồ Chơi DX Valvarusher', 6666, 1, '6666', 'Thanh toán trực tiếp', 'Đã xác nhận', '<ul><li>trung nguyen1</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công;từ hội trường thôn thái công bắc đi thẳng vào 200m , dừng ở chỗ sân to bên phải đường</li></ul>', 'Bản sao của valvar rusher.png', '2023-12-01 06:09:02', '2023-11-30 18:03:31'),
(4, '492509746', '389710384', '1', 'Đồ Chơi DX Valvarusher', 6, 2, '13332', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen1</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công;từ hội trường thôn thái công bắc đi thẳng vào 200m , dừng ở chỗ sân to bên phải đường</li></ul>', 'Bản sao của valvar rusher.png', '2023-11-30 18:05:02', '2023-11-30 18:05:51'),
(5, '418801135', '', 'user', 'Đồ Chơi DX Valvarusher', 9905, 1, '9905', 'Thanh toán trực tiếp', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của valvar rusher.png', '2023-12-01 05:57:00', '2023-12-01 05:57:00'),
(6, '906335521', '', 'user', 'Đồ Chơi DX Gotchard Driver', 1499000, 1, '1499000', 'Thanh toán trực tiếp', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png', '2023-12-01 05:57:58', '2023-12-01 05:57:58'),
(7, '880610793', '', 'user', 'Đồ Chơi DX Gotchard Driver', 1699000, 2, '3398000', 'Thanh toán trực tiếp', 'Đã xác nhận', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png', '2023-12-01 06:08:55', '2023-12-01 05:58:22'),
(8, '778872355', '', 'user', 'Đồ Chơi DX Gotchanko Panel', 899000, 1, '899000', 'Thanh toán trực tiếp', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của Bản sao của Bản sao của dark tarantula b1.png', '2023-12-01 05:58:34', '2023-12-01 05:58:34'),
(9, '528723324', '', 'user', 'Đồ Chơi Valvarad Draw Buckle', 799000, 1, '799000', 'Thanh toán trực tiếp', 'Đã xác nhận', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'valvaar holder.png', '2023-12-01 06:30:37', '2023-12-01 05:59:02'),
(10, '481920053', '', 'user', 'Mô Hình SHFiguart Ultraman Blazar', 1399000, 1, '1399000', 'Thanh toán trực tiếp', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của chemy spanner.png', '2023-12-01 06:31:23', '2023-12-01 05:59:11'),
(11, '278038806', '', 'user', 'Thẻ bài Ride Chemy Card PHASE:02', 69900, 1, '69900', 'Thanh toán trực tiếp', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của phase 02.png', '2023-12-01 06:31:15', '2023-12-01 05:59:20'),
(12, '302738966', '', 'user', 'Nguyên Hộp Thẻ bài Ride Chemy Card PHASE:02', 1099000, 1, '1099000', 'Thanh toán trực tiếp', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của Bản sao của Bản sao của kkk.png', '2023-12-01 06:31:06', '2023-12-01 05:59:31'),
(13, '270613715', '', 'user', 'HG 1/144 L-Frith', 699000, 1, '699000', 'Thanh toán trực tiếp', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'HG_Gundam_Lfrith.webp', '2023-12-01 06:31:04', '2023-12-01 05:59:43'),
(14, '970116546', '766095197', 'user', 'HG 1/144 Aerial', 699, 1, '699000', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'HG_Gundam_Aerial.webp', '2023-12-01 06:30:57', '2023-12-01 06:02:26'),
(15, '116890284', '716142366', 'user', 'CSM Faiz Gear ver1.5 ', 8, 1, '8990000', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'cyf8e4n5.png', '2023-12-01 06:30:55', '2023-12-01 06:03:47'),
(16, '902609469', '872421693', 'user', 'Đồ Chơi DX Valvarusher1111', 23, 1, '23331', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'bandai-namco-metaverse.jpg', '2023-12-01 06:30:51', '2023-12-01 06:05:47'),
(17, '631300571', '872421693', 'user', 'Đồ Chơi DX Gotchard Driver', 1, 1, '1499000', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png', '2023-12-01 06:30:48', '2023-12-01 06:05:47'),
(18, '155821817', '872421693', 'user', 'Đồ Chơi DX Valvarusher', 666, 1, '666666', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của valvar rusher.png', '2023-12-01 06:24:25', '2023-12-01 06:24:28'),
(19, '177390049', '872421693', 'user', 'Thẻ bài Ride Chemy Card PHASE:02', 69, 1, '69900', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'Bản sao của phase 02.png', '2023-12-01 06:20:49', '2023-12-01 06:05:47'),
(20, '450032966', '872421693', 'user', 'CSM Kabuto Zecter ver1.5', 4, 1, '4990000', 'vnpay', 'Đang giao hàng', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'r1rcotul.png', '2023-12-01 06:14:51', '2023-12-01 06:05:47'),
(21, '516937451', '872421693', 'user', 'CSM Faiz Gear ver1.5 ', 8, 1, '8990000', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'cyf8e4n5.png', '2023-12-01 06:20:45', '2023-12-01 06:33:46'),
(22, '248280058', '872421693', 'user', 'CSM OOO Driver 10th', 6, 1, '6990000', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'i1zk5iuf.png', '2023-12-01 06:15:32', '2023-12-01 06:33:44'),
(23, '877972748', '872421693', 'user', 'HG 1/144 Lidanza', 699, 1, '699000', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'HG_Gundam_Pharact.webp', '2023-12-01 06:15:10', '2023-12-01 06:33:42'),
(24, '828577412', '872421693', 'user', 'HG 1/144 Aerial', 699, 1, '699000', 'vnpay', 'Đã hoàn thành', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15ghjkkfjfjgjjjxsdfg</li></ul>', 'HG_Gundam_Aerial.webp', '2023-12-01 06:11:11', '2023-12-01 06:20:56'),
(39, '879293227', '840541823', '1', 'Đồ Chơi DX Gotchard Driver', 1499000, 2, '2998000', 'vnpay', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15</li></ul>', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png', '2023-12-07 14:47:01', '2023-12-07 14:47:01'),
(40, '153067799', '404040345', '1', 'Đồ Chơi DX Gotchard Driver', 1699000, 1, '1699000', 'vnpay', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15</li></ul>', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png', '2023-12-07 14:48:02', '2023-12-07 14:48:02'),
(43, '354503930', '', '1', 'Đồ Chơi DX Valvarusher', 9905, 1, '9905', 'Thanh toán trực tiếp', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15</li></ul>', 'Bản sao của valvar rusher.png', '2023-12-07 14:53:16', '2023-12-07 14:53:16'),
(44, '252085210', '', '1', 'Đồ Chơi DX Valvarusher', 9905, 3, '29715', 'vnpay', 'Đang xử lý', '<ul><li>trung nguyen</li><li>0375716892</li><li>Thái bình;kiến xương;vũ công23456;15</li></ul>', 'Bản sao của valvar rusher.png', '2023-12-07 15:00:58', '2023-12-07 15:00:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(12, 'Đồ Chơi Bandai DX'),
(13, 'Mô Hình Động Bandai SHFiguart'),
(14, 'Mô Hình Cao Cấp Bandai Complete Selection Modification'),
(16, 'Trading Card Game'),
(18, 'Phụ Kiện Sưu Tập'),
(21, 'Mô Hình Lắp Ráp Gundam Model Kit');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender_id` varchar(30) NOT NULL,
  `receiver_id` varchar(30) NOT NULL,
  `msg` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_id`, `receiver_id`, `msg`, `date`) VALUES
(1, '253845', ' 793528', 'dfghhgfdfghj', '2023-11-08 16:43:55'),
(2, '253845', ' 793528', 'dfghhgfdfghj', '2023-11-08 16:44:31'),
(3, '253845', ' 793528', 'dfghhgfdfghj', '2023-11-08 16:44:33'),
(4, '253845', ' 793528', 'dfghhgfdfghj', '2023-11-08 16:44:36'),
(5, '253845', ' 793528', 'dfghhgfdfghj', '2023-11-08 16:48:36'),
(6, '793528', ' 253845', 'dfghujioiuyfrdesedrfgyuytres', '2023-11-08 16:51:07'),
(7, '793528', ' 253845', 'dfghujioiuyfrdesedrfgyuytres', '2023-11-08 16:51:28'),
(8, '793528', ' 253845', 'dfghjhgfd', '2023-11-08 16:52:31'),
(9, '793528', ' 253845', 'dfghjhgfdfghjgfd', '2023-11-08 16:52:44'),
(10, '253845', ' 793528', 'drfghjhgfdfgh', '2023-11-08 16:53:05'),
(11, '793528', '793528', 'dfghjhgfdfghjhgfd', '2023-11-08 16:57:19'),
(12, '793528', '793528', 'dfghjhgfdq23456', '2023-11-08 17:17:16'),
(13, '253845', ' 793528', 'dfghjkjhgfcdxcvbnm,', '2023-11-08 17:31:05'),
(14, '253845', ' 793528', 'ẻtyuytrfrty', '2023-11-08 17:31:17'),
(15, '793528', ' 253845', '2345', '2023-11-08 17:31:44'),
(16, '253845', ' 793528', '3456789', '2023-11-08 17:32:01'),
(17, '253845', ' 793528', 'ưertytr', '2023-11-08 17:33:19'),
(18, '793528', '793528', 'cvbhcvbhj', '2023-11-08 17:33:26'),
(19, '793528', ' 253845', '2345', '2023-11-08 17:33:46'),
(20, '793528', ' 253845', '2345', '2023-11-08 17:34:09'),
(21, '793528', ' 253845', 'sdfghnjmk', '2023-11-08 17:34:13'),
(22, '253845', ' 793528', 'fgthyujiolp;olik', '2023-11-08 17:34:27'),
(23, '793528', ' 253845', 'dfgyhujikoluhygfghj', '2023-11-08 17:38:16'),
(24, '253845', ' 793528', 'fghjiohgvcdxcfvgbhjikofvhjiko', '2023-11-08 17:39:28'),
(25, '253845', ' 793528', 'dcfvgbhnjmk,l.;', '2023-11-08 17:40:07'),
(26, '253845', ' 793528', 'sedrfghujhgfdfgyh', '2023-11-08 17:41:12'),
(27, '253845', ' 793528', 'sưertrerer', '2023-11-08 17:46:51'),
(28, '793528', ' 253845', 'dfghyjuklkjhgfd', '2023-11-09 09:34:49'),
(29, '793528', ' 253845', 'dfghjkl;plkjhgfd', '2023-11-09 09:44:23'),
(30, '793528', ' 253845', 'sưdefrgthyujikujhytgrfed', '2023-11-09 09:44:32'),
(31, '793528', ' 253845', 'sdfgthyujiouytr', '2023-11-09 09:49:16'),
(32, '253845', ' 834863', 'dfghjkjhgfghjki', '2023-11-09 09:54:49'),
(33, '253845', ' 834863', '1234567890', '2023-11-09 09:55:05'),
(34, '253845', ' 834863', 'dfghjkjhgfdf', '2023-11-09 09:56:30'),
(35, '793528', ' 123456', 'hygfdsdfghukol;olikujhgt', '2023-11-09 09:56:42'),
(36, '253845', ' 793528', '', '2023-11-09 10:08:09'),
(37, '253845', ' 793528', '', '2023-11-09 10:08:52'),
(38, '253845', ' 793528', '', '2023-11-09 10:08:57'),
(39, '793528', ' 253845', 'ưertyuioiuyt', '2023-11-09 11:00:31'),
(40, '253845', ' 793528', 'ètghjkolplkjhg', '2023-11-09 11:00:54'),
(41, '253845', ' 793528', 'sdfghjk', '2023-11-27 15:11:42'),
(42, '793528', ' 253845', 'dsfghujik', '2023-11-27 15:11:54'),
(43, '253845', ' 793528', 'sdfghyuj', '2023-11-27 15:12:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_amount` float NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL,
  `get_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_code`, `order_name`, `order_quantity`, `order_amount`, `order_status`, `order_currency`, `get_date`) VALUES
(1, '47585027', 'diend', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-20 20:48:00'),
(2, '66918588', 'wizard', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-20 20:48:48'),
(3, '730391451', 'wizard', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-20 20:48:48'),
(4, '773709991', 'wizard', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-20 20:50:00'),
(5, '150450258', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-21 00:10:18'),
(6, '597502753', 'wizard', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-21 00:12:17'),
(7, '562497643', 'wizard', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-21 00:13:03'),
(8, '453668764', 'diend', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-23 03:28:26'),
(9, '346575335', 'diend', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-23 03:39:38'),
(10, '750238270', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-23 03:40:59'),
(11, '585156991', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-23 03:41:19'),
(12, '475850179', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-23 03:41:38'),
(13, '958814256', 'double', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-29 19:32:45'),
(14, '958814256', 'double', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-29 19:32:48'),
(15, '559750249', 'fourze', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-29 19:33:10'),
(16, '559750249', 'fourze', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-29 19:33:13'),
(17, '306691816', 'double', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-29 19:33:32'),
(20, '873039141', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-30 00:00:27'),
(21, '773709925', 'diend', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-30 00:18:24'),
(22, '773709925', 'diend', 1, 950000, 'Đã hoàn thành', 'VND', '2023-10-30 00:18:24'),
(23, '104502585', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-10-30 07:25:59'),
(24, '397570803', 'decade', 1, 9500000, 'Đã hoàn thành', 'VND', '2023-11-03 00:33:25'),
(25, '4', '', 0, 0, 'Đã hoàn thành', 'VND', '2023-11-30 18:05:38'),
(26, '492509746', 'Đồ Chơi DX Valvarusher', 2, 13332, 'Đã hoàn thành', 'VND', '2023-11-30 18:05:51'),
(27, '828577412', 'HG 1/144 Aerial', 1, 699000, 'Đã hoàn thành', 'VND', '2023-12-01 06:20:56'),
(28, '155821817', 'Đồ Chơi DX Valvarusher', 1, 666666, 'Đã hoàn thành', 'VND', '2023-12-01 06:24:28'),
(29, '877972748', 'HG 1/144 Lidanza', 1, 699000, 'Đã hoàn thành', 'VND', '2023-12-01 06:33:42'),
(30, '248280058', 'CSM OOO Driver 10th', 1, 6990000, 'Đã hoàn thành', 'VND', '2023-12-01 06:33:44'),
(31, '516937451', 'CSM Faiz Gear ver1.5 ', 1, 8990000, 'Đã hoàn thành', 'VND', '2023-12-01 06:33:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_description`, `short_desc`, `product_image`) VALUES
(102, 'Đồ Chơi DX Valvarusher', 12, 'ewrtyurergthy', '23456', 'Bản sao của valvar rusher.png'),
(103, 'Đồ Chơi DX Gotchard Driver', 12, 'Sản phẩm từ Series Kamen Rider GotChard ( 2023 ) thuộc dòng phim Kamen Rider đình đám dành cho thanh thiếu niên tại Nhật Bản\r\nMô phỏng các thiết bị biến thân được sử dụng trong phim , tích hợp âm thanh ánh sáng , chơi cùng DX Ride Chemy Card cho ra âm thanh ánh sáng khác nhau\r\n\r\n> Thông tin sản phẩm : \r\n+ Năm sản xuất : 2023\r\n+ Năm phát hành : 9/2023\r\n+ Nhà sản xuất : Bandai Namco\r\n+ Chất Liệu : Nhựa PBT , Giấy\r\n+Nguồn : Pin AAA*3\r\nPhù hợp cho trẻ từ 6 tuổi trở lên\r\n\r\n> Thành Phần : \r\n+ Driver *1\r\n+ Ride Chemy Card *3\r\nCam kết sản phẩm chính hãng Bandai Namco 100% , hoàn tiền cho mọi trường hợp phát hiện hàng nhái , hàng giả , hàng kém chất lượng không giống cam kết\r\nMọi thắc mắc liên hệ Chicken Hobby - Chuyên Deal Ngon Giá Tốt để được giải đáp mua hàng', 'Thiết bị biến thân 2023', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png'),
(104, 'Đồ Chơi DX Gotchard Driver', 12, '', '', 'Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Bản sao của Thiết kế không tên.png'),
(105, 'Đồ Chơi DX Gotchanko Panel', 12, '', '', 'Bản sao của Bản sao của Bản sao của dark tarantula b1.png'),
(106, 'Đồ Chơi Valvarad Draw Buckle', 12, 'Sản phẩm từ Series Kamen Rider GotChard ( 2023 ) thuộc dòng phim Kamen Rider đình đám dành cho thanh thiếu niên tại Nhật Bản\r\nMô phỏng các thiết bị biến thân được sử dụng trong phim , tích hợp âm thanh ánh sáng , chơi cùng DX Ride Chemy Card cho ra âm thanh ánh sáng khác nhau\r\n\r\n> Thông tin sản phẩm : \r\n+ Năm sản xuất : 2023\r\n+ Năm phát hành : 9/2023\r\n+ Nhà sản xuất : Bandai Namco\r\n+ Chất Liệu : Nhựa PBT , Giấy\r\n+Nguồn : Pin AAA*3\r\nPhù hợp cho trẻ từ 6 tuổi trở lên\r\n\r\n> Thành Phần : \r\n+ Valvar Rusher *1\r\n+ Ride Chemy Card *3\r\nCam kết sản phẩm chính hãng Bandai Namco 100% , hoàn tiền cho mọi trường hợp phát hiện hàng nhái , hàng giả , hàng kém chất lượng không giống cam kết\r\nMọi thắc mắc liên hệ Chicken Hobby - Chuyên Deal Ngon Giá Tốt để được giải đáp mua hàng', 'Công cụ lưu trữ thẻ bài', 'valvaar holder.png'),
(107, 'Mô Hình SHFiguart Ultraman Blazar', 13, 'Sản phẩm đến từ series Ultraman Blazar ( 2023 ) thuộc dòng phim Ultraman ( Siêu Nhân Điện Quang ) đình đám Nhật Bản dành cho thanh thiếu niên\r\nMô phỏng lại hình dáng chiến đấu của các nhân vật Ultraman trong phim với tỉ lệ trưng bày ,\r\nSản phẩm cấu tạo bởi các khớp động linh hoạt giúp người chơi có thể tự do tạo dáng cho mô hình nhân vật theo ý muốn\r\nthích hợp để trưng bày trong bộ sưu tập \r\n\r\n> Thông tin sản phẩm :\r\n+ Năm Phát Hành : 11/2023\r\n+ Năm Sản Xuất : 2023\r\n+ Thương Hiệu : Bandai Namco\r\n+ Chất Liệu : Nhựa PBT \r\n+ Xuất Xứ : Nhật Bản\r\nPhù hợp an toàn cho trẻ em từ 15 tuổi trở lên\r\nSản phẩm mới nguyên hộp từ Nhật Bản\r\n\r\nCam Kết hàng thật chính hãng Bandai Nhật Bản 100% - Hoàn Tiền cho mọi trường hợp phát hiện hàng giả hàng nhái hàng kém chất lượng từ bên ngoài\r\nMọi thông tin chi tiết liên hệ ngay Fb Page : Chicken Hobby - Chuyên Deal Ngon Giá Tốt để được giải đáp và tư vấn mua hàng ^^', 'Mô hình trưng bày', 'Bản sao của chemy spanner.png'),
(108, 'Mô Hình SHFiguart Kugawata Ohger', 13, 'Sản phẩm đến từ Series Ohsama KIngOhger ( 2023 ) thuộc dòng phim Super Sentai (5 Anh Em Siêu Nhân) đình đám Nhật Bản dành cho thanh thiếu niên\r\nMô phỏng lại hình dáng chiến đấu của các nhân vật Kamen Rider trong phim với tỉ lệ trưng bày ,\r\nSản phẩm cấu tạo bởi các khớp động linh hoạt giúp người chơi có thể tự do tạo dáng cho mô hình nhân vật theo ý muốn\r\nthích hợp để trưng bày trong bộ sưu tập \r\n\r\n> Thông tin sản phẩm :\r\n+ Năm Phát Hành : 11/2023\r\n+ Năm Sản Xuất : 2023\r\n+ Thương Hiệu : Bandai Namco\r\n+ Chất Liệu : Nhựa PBT \r\n+ Xuất Xứ : Nhật Bản\r\nPhù hợp an toàn cho trẻ em từ 12 tuổi trở lên\r\nSản phẩm mới nguyên hộp từ Nhật Bản\r\n\r\nCam Kết hàng thật chính hãng Bandai Nhật Bản 100% - Hoàn Tiền cho mọi trường hợp phát hiện hàng giả hàng nhái hàng kém chất lượng từ bên ngoài\r\n\r\nMọi thông tin chi tiết liên hệ ngay Fb Page : Chicken Hobby - Chuyên Deal Ngon Giá Tốt để được giải đáp và tư vấn mua hàng ^^', 'Mô hình trưng bày', 'Bản sao của kkk (1).png'),
(109, 'Thẻ bài Ride Chemy Card PHASE:02', 16, '', '', 'Bản sao của phase 02.png'),
(110, 'Nguyên Hộp Thẻ bài Ride Chemy Card PHASE:02', 16, '', '', 'Bản sao của Bản sao của Bản sao của kkk.png'),
(111, 'HG 1/144 L-Frith', 21, 'Mô hình lắp ráp 1/144 HG GUNDAM LFRITH (MOBILE SUIT GUNDAM THE WITCH FROM MERCURY) Bandai\r\n-	Sản Phẩm Nhựa Cao Cấp Với Độ Sắc Nét Cao\r\n-	Sản Xuất Bởi Bandai Namco – Nhật Bản\r\n-	An Toàn Với Trẻ Em\r\n-	Phát Triển Trí Não Cho Trẻ Hiệu Quả Đi Đôi Với Niềm Vui Thích Bất Tận\r\n-	Rèn Luyện Tính Kiên Nhẫn Cho Người Chơi\r\n-	Phân Phối Bởi GundamGDC\r\n-	Thông Tin Cơ Bản :\r\no	Mô Hình Gundam (Gunpla) Là Một Loại Mô Hình Nhựa Được Gọi Là Model Kit, Bao Gồm Nhiều Mảnh Nhựa Rời Được Gọi Là Part (Bộ Phận), Khi Lắp Ráp Các Part Lại Với Nhau Sẽ Được Mô Hình Hoàn Chỉnh. Các Mảnh Nhựa Rời Này Được Gắn Trên Khung Nhựa Gọi Là Runner. Mỗi Một Hộp Sản Phẩm Gunpla Bao Gồm Nhiều Runner Và Các Phụ Kiện Liên Quan, Một Tập Sách Nhỏ (Manual) Bên Trong Giới Thiệu Sơ Lược Về Mẫu Gundam Trong Hộp Và Phần Hướng Dẫn Cách Lắp Ráp.\r\no	Dòng Gundam Với Các Chi Tiết Hoàn Hảo.\r\no	Các Khớp Cử Động Linh Hoạt Theo Ý Muốn.\r\no	Người Chơi Sẽ Thỏa Sức Sáng Tạo Và Đam Mê.', 'Lắp ráp gundam', 'HG_Gundam_Lfrith.webp'),
(114, 'HG 1/144 Aerial', 21, 'Mô hình lắp ráp 1/144 HG GUNDAM LFRITH (MOBILE SUIT GUNDAM THE WITCH FROM MERCURY) Bandai\r\n-	Sản Phẩm Nhựa Cao Cấp Với Độ Sắc Nét Cao\r\n-	Sản Xuất Bởi Bandai Namco – Nhật Bản\r\n-	An Toàn Với Trẻ Em\r\n-	Phát Triển Trí Não Cho Trẻ Hiệu Quả Đi Đôi Với Niềm Vui Thích Bất Tận\r\n-	Rèn Luyện Tính Kiên Nhẫn Cho Người Chơi\r\n-	Phân Phối Bởi GundamGDC\r\n-	Thông Tin Cơ Bản :\r\no	Mô Hình Gundam (Gunpla) Là Một Loại Mô Hình Nhựa Được Gọi Là Model Kit, Bao Gồm Nhiều Mảnh Nhựa Rời Được Gọi Là Part (Bộ Phận), Khi Lắp Ráp Các Part Lại Với Nhau Sẽ Được Mô Hình Hoàn Chỉnh. Các Mảnh Nhựa Rời Này Được Gắn Trên Khung Nhựa Gọi Là Runner. Mỗi Một Hộp Sản Phẩm Gunpla Bao Gồm Nhiều Runner Và Các Phụ Kiện Liên Quan, Một Tập Sách Nhỏ (Manual) Bên Trong Giới Thiệu Sơ Lược Về Mẫu Gundam Trong Hộp Và Phần Hướng Dẫn Cách Lắp Ráp.\r\no	Dòng Gundam Với Các Chi Tiết Hoàn Hảo.\r\no	Các Khớp Cử Động Linh Hoạt Theo Ý Muốn.\r\no	Người Chơi Sẽ Thỏa Sức Sáng Tạo Và Đam Mê.', 'Lắp ráp gundam', 'HG_Gundam_Aerial.webp'),
(115, 'HG 1/144 Beu', 21, 'Mô hình lắp ráp 1/144 HG GUNDAM LFRITH (MOBILE SUIT GUNDAM THE WITCH FROM MERCURY) Bandai\r\n-	Sản Phẩm Nhựa Cao Cấp Với Độ Sắc Nét Cao\r\n-	Sản Xuất Bởi Bandai Namco – Nhật Bản\r\n-	An Toàn Với Trẻ Em\r\n-	Phát Triển Trí Não Cho Trẻ Hiệu Quả Đi Đôi Với Niềm Vui Thích Bất Tận\r\n-	Rèn Luyện Tính Kiên Nhẫn Cho Người Chơi\r\n-	Phân Phối Bởi GundamGDC\r\n-	Thông Tin Cơ Bản :\r\no	Mô Hình Gundam (Gunpla) Là Một Loại Mô Hình Nhựa Được Gọi Là Model Kit, Bao Gồm Nhiều Mảnh Nhựa Rời Được Gọi Là Part (Bộ Phận), Khi Lắp Ráp Các Part Lại Với Nhau Sẽ Được Mô Hình Hoàn Chỉnh. Các Mảnh Nhựa Rời Này Được Gắn Trên Khung Nhựa Gọi Là Runner. Mỗi Một Hộp Sản Phẩm Gunpla Bao Gồm Nhiều Runner Và Các Phụ Kiện Liên Quan, Một Tập Sách Nhỏ (Manual) Bên Trong Giới Thiệu Sơ Lược Về Mẫu Gundam Trong Hộp Và Phần Hướng Dẫn Cách Lắp Ráp.\r\no	Dòng Gundam Với Các Chi Tiết Hoàn Hảo.\r\no	Các Khớp Cử Động Linh Hoạt Theo Ý Muốn.\r\no	Người Chơi Sẽ Thỏa Sức Sáng Tạo Và Đam Mê.', 'Lắp ráp gundam', 'HG_Beguir-Beu.webp'),
(119, 'HG 1/144 Lidanza', 21, 'Mô hình lắp ráp 1/144 HG GUNDAM LFRITH (MOBILE SUIT GUNDAM THE WITCH FROM MERCURY) Bandai\r\n-	Sản Phẩm Nhựa Cao Cấp Với Độ Sắc Nét Cao\r\n-	Sản Xuất Bởi Bandai Namco – Nhật Bản\r\n-	An Toàn Với Trẻ Em\r\n-	Phát Triển Trí Não Cho Trẻ Hiệu Quả Đi Đôi Với Niềm Vui Thích Bất Tận\r\n-	Rèn Luyện Tính Kiên Nhẫn Cho Người Chơi\r\n-	Phân Phối Bởi GundamGDC\r\n-	Thông Tin Cơ Bản :\r\no	Mô Hình Gundam (Gunpla) Là Một Loại Mô Hình Nhựa Được Gọi Là Model Kit, Bao Gồm Nhiều Mảnh Nhựa Rời Được Gọi Là Part (Bộ Phận), Khi Lắp Ráp Các Part Lại Với Nhau Sẽ Được Mô Hình Hoàn Chỉnh. Các Mảnh Nhựa Rời Này Được Gắn Trên Khung Nhựa Gọi Là Runner. Mỗi Một Hộp Sản Phẩm Gunpla Bao Gồm Nhiều Runner Và Các Phụ Kiện Liên Quan, Một Tập Sách Nhỏ (Manual) Bên Trong Giới Thiệu Sơ Lược Về Mẫu Gundam Trong Hộp Và Phần Hướng Dẫn Cách Lắp Ráp.\r\no	Dòng Gundam Với Các Chi Tiết Hoàn Hảo.\r\no	Các Khớp Cử Động Linh Hoạt Theo Ý Muốn.\r\no	Người Chơi Sẽ Thỏa Sức Sáng Tạo Và Đam Mê.', 'Lắp ráp gundam', 'HG_Gundam_Pharact.webp'),
(120, 'CSM OOO Driver 10th', 14, 'Dòng đồ chơi cao cấp dành cho đối tượng trưởng thành mở bán theo hình thức giới hạn\r\n\r\n> Thông tin : \r\n+ Năm sản xuất : 2022\r\n+ Năm phát hành : 2022\r\n+ Chất liệu : Nhựa PBT\r\nPhù hợp cho người từ 14 tuổi \r\n\r\nLiên hệ để được tư vấn và hỗ trợ đặt mua', 'Đồ chơi cao cấp', 'i1zk5iuf.png'),
(122, 'CSM Faiz Gear ver1.5 ', 14, '', '', 'cyf8e4n5.png'),
(123, 'CSM Dark Kivat Belt', 14, 'Dòng đồ chơi cao cấp dành cho đối tượng trưởng thành mở bán theo hình thức giới hạn\r\n\r\n> Thông tin : \r\n+ Năm sản xuất : 2022\r\n+ Năm phát hành : 2022\r\n+ Chất liệu : Nhựa PBT\r\nPhù hợp cho người từ 14 tuổi \r\n\r\nLiên hệ để được tư vấn và hỗ trợ đặt mua', 'Đồ chơi cao cấp', 'zdtyctg1.png'),
(124, 'CSM Kabuto Zecter ver1.5', 14, '', '', 'r1rcotul.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `report_code` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `report_file` varchar(255) NOT NULL,
  `star` varchar(3) NOT NULL,
  `comment` varchar(70) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reports`
--

INSERT INTO `reports` (`report_id`, `report_code`, `user_name`, `product_name`, `report_file`, `star`, `comment`, `date`) VALUES
(12, '492509746', '1', 'Đồ Chơi DX Valvarusher', 'agito.jpg', '31', 'ưergthjkhgfdsadfgbnhgfd', '2023-11-30 18:07:01'),
(13, '516937451', 'user', 'CSM Faiz Gear ver1.5 ', 'akaranger.jpg', '5', 'Chi tiết chân thực, chất liệu chắc chắn. Việc lắp ráp đơn giản, mang l', '2023-12-01 06:39:28'),
(14, '248280058', 'user', 'CSM OOO Driver 10th', 'Bản sao của Bản sao của Bản sao của kkk.png', '5', 'Sản phẩm vượt xa mong đợi! Mô hình có độ chi tiết cao, cùng với khả nă', '2023-12-01 06:40:38'),
(15, '155821817', 'user', 'Đồ Chơi DX Valvarusher', 'Bản sao của chemy spanner.png', '5', '\r\nSản phẩm thực sự tuyệt vời! Chi tiết cực kỳ sắc nét, rất giống với t', '2023-12-01 06:41:36'),
(16, '877972748', 'user', 'HG 1/144 Lidanza', 'diend.jpg', '5', 'Sản phẩm rất đẹp và độc đáo! Tạo cảm giác retro, giữ lại sự đặc trưng ', '2023-12-01 06:42:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_image`) VALUES
(23, '1', '115_1381_o_1he4u13rgcgr5r81juqs4q1ka0c.jpg'),
(24, '2', '115_1385_o_1hcul2l8ovp41cfa1qfj1jmn3qpc.jpg'),
(25, '3', '74_3389_o_1hei9rq6svtmuanijd1ocn13n37.jpg'),
(26, '4', '115_1215_o_1grjtv6msn211vofatv1ivm1ds3c.jpg'),
(27, '5', '115_1264_o_1h2ck9l869b5127mjkjlcs4kfc.jpg'),
(28, '6', '74_3358_o_1hd0ho2ml1m2ief1f9f5u1jb47.jpg'),
(29, '7', '115_1190_o_1gn6b3bau1n321jv3j1179hebkc.jpg'),
(30, '8', '115_1366_o_1hbnevhl118dn1r2kqvutthttrc.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_level` char(1) NOT NULL,
  `msg_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_photo` text NOT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_level`, `msg_id`, `username`, `first_name`, `last_name`, `sex`, `email`, `password`, `user_photo`, `birthday`) VALUES
(2, '1', '123456', 'user', 'trung', 'nguyen', 'nam', 'hhjjaa99922@gmail.com', '1234', 'agito.jpg', '2013-10-30'),
(5, '1', '253845', '1', 'trung', 'nguyen1', 'nam', 'tapnham15402@gmail.com', '1', 'dragonranger.jpg', '2002-11-20'),
(6, '2', '793528', '2', 'trung1', 'nguyen', 'nam', 'hhjjaa9992@gmail.com', '1', 'diend.jpg', '2013-11-07'),
(7, '1', '548172', '12', 'trungq', 'trung', 'nam', 'lemann78783457@gmail.com', '1', 'decade.jpg', '2013-11-07'),
(8, '1', '823410', 'tendai1', 'asdfgh', 'asdfghjkl', 'nu', 'sdfghjk@dsfghj.sdfgh', '1234', 'shin.jpg', '2013-11-07'),
(9, '1', '734025', 'ashy1234', 'wesdrtfhghuijok', 'nguyen', 'nu', 'hhjjaa999245@gmail.com', '', '_a616f20d-5e2a-414b-864f-5af7f1886ed9.jfif', '2013-11-07'),
(14, '1', '472915', '123', 'trung1', 'nguyen', 'nam', 'tapnham150we2@gmail.com', '1234', 'drive.jpg', '2013-11-07'),
(15, '1', '153781', '34', 'sdfgh', 'llkjhg', 'nam', 'cvhnn@gmail.com', '1', '_a616f20d-5e2a-414b-864f-5af7f1886ed9.jfif', '2013-11-07'),
(16, '2', '834863', 'admin', 'trung', 'nguyen1', '', 'tapnham15dwefrgth02@gmail.com', '1', 'exaid.jpg', '2013-11-07');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `amount`
--
ALTER TABLE `amount`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `buy_code` (`buy_code`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `sender_id` (`sender_id`,`receiver_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_name` (`order_name`),
  ADD KEY `order_code` (`order_code`,`order_name`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category_id` (`product_category_id`),
  ADD KEY `product_title` (`product_title`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_code` (`report_code`,`user_name`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `msg_id` (`msg_id`,`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `amount`
--
ALTER TABLE `amount`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT cho bảng `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
