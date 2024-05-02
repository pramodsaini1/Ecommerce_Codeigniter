-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 10:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `username`, `email`, `password`) VALUES
(1, 'U23asdPxZ', 'Pramod Kumar Saini', 'pramodsaini@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `ec_banner`
--

CREATE TABLE `ec_banner` (
  `id` int(11) NOT NULL,
  `banner_id` varchar(30) NOT NULL,
  `banner_img` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_banner`
--

INSERT INTO `ec_banner` (`id`, `banner_id`, `banner_img`, `status`, `added_on`, `updated_on`) VALUES
(1, 'PQjqx0_1', './uploads/banner-slider-2.png', 0, '2024-04-30', NULL),
(2, 'FJgtu7_2', './uploads/banner-slider-3.png', 0, '2024-04-30', NULL),
(3, 'CPZir0_3', './uploads/banner-slider-1.png', 0, '2024-04-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ec_cart`
--

CREATE TABLE `ec_cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `cart_id` varchar(30) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `product_name` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_cart`
--

INSERT INTO `ec_cart` (`id`, `user_id`, `cart_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `slug`, `product_image`, `added_on`, `updated_on`) VALUES
(1, 'U23CDil12_1', 'C23BSamt7_1', '40886', 'PTron Bassbuds Duo', 1, '720', 'ptron-bassbuds-duo', './uploads/product-offer-2.jpg', '2024-04-30', ''),
(2, 'U23CDil12_1', 'C23BJMYyz_2', '42120', 'Sony ZX110', 1, '799', 'sony-zx110', './uploads/product-10.jpg', '2024-04-30', '');

-- --------------------------------------------------------

--
-- Table structure for table `ec_category`
--

CREATE TABLE `ec_category` (
  `id` int(11) NOT NULL,
  `category_id` varchar(30) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_img` varchar(80) DEFAULT NULL,
  `parent_id` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` text DEFAULT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_category`
--

INSERT INTO `ec_category` (`id`, `category_id`, `category_name`, `category_img`, `parent_id`, `status`, `slug`, `added_on`, `updated_on`) VALUES
(1, 'AGNar7_1', 'Mobile', './uploads/product-cat-2.png', '', 0, 'mobile', '30 Apr,2024', NULL),
(2, 'KLfos0_2', 'Digital Watch', './uploads/product-cat-4.png', 'AGNar7_1', 0, 'digital-watch', '30 Apr,2024', NULL),
(3, 'JNnwz1_3', 'HeadPhone', './uploads/product-cat-1.png', '', 0, 'headphone', '30 Apr,2024', NULL),
(4, 'Wjmnqz_4', 'CPU Heat Pipes', './uploads/product-cat-3.png', 'AGNar7_1', 0, 'cpu-heat-pipes', '30 Apr,2024', NULL),
(5, 'GOYhiv_5', 'With Bluetooth', './uploads/product-cat-5.png', 'JNnwz1_3', 0, 'with-bluetooth', '30 Apr,2024', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ec_customers`
--

CREATE TABLE `ec_customers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `user_image` text DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ec_order`
--

CREATE TABLE `ec_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(30) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_img` varchar(30) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `delivery_charge` varchar(15) NOT NULL,
  `total` varchar(15) NOT NULL,
  `payment_mode` text NOT NULL,
  `customer_name` text NOT NULL,
  `customer_mobile` varchar(40) NOT NULL,
  `customer_email` varchar(60) NOT NULL,
  `pincode` int(11) NOT NULL,
  `address` text NOT NULL,
  `address_2` text NOT NULL,
  `state` text NOT NULL,
  `city` text NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `delivery_date` varchar(30) NOT NULL,
  `order_date` varchar(30) NOT NULL,
  `order_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `updated_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ec_pincode`
--

CREATE TABLE `ec_pincode` (
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `delivery_charge` varchar(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_pincode`
--

INSERT INTO `ec_pincode` (`id`, `pincode`, `delivery_charge`, `status`) VALUES
(1, 333307, '120', 0),
(2, 302003, '50', 0),
(3, 302001, '390', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ec_product`
--

CREATE TABLE `ec_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `p_id` varchar(80) DEFAULT NULL,
  `category` varchar(30) NOT NULL,
  `sub_category` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_mrp` float DEFAULT NULL,
  `product_selling_price` float DEFAULT NULL,
  `brand` varchar(30) NOT NULL,
  `featured` text NOT NULL,
  `highlights` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `meta_title` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `gallery_img` varchar(255) NOT NULL,
  `sold` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `added_on` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `updated_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_product`
--

INSERT INTO `ec_product` (`id`, `product_id`, `p_id`, `category`, `sub_category`, `product_name`, `product_mrp`, `product_selling_price`, `brand`, `featured`, `highlights`, `description`, `meta_title`, `meta_keywords`, `meta_description`, `product_main_image`, `gallery_img`, `sold`, `status`, `slug`, `stock`, `added_on`, `ip`, `updated_on`) VALUES
(1, 'GSew59_1', '35357', 'AGNar7_1', 'Wjmnqz_4', 'Horizon X1', 5600, 5300, 'Samsung', '1', '6.5-inch Super AMOLED display with 120Hz refresh rate\r\nTriple-camera setup with 64MP main sensor, 8MP ultra-wide, and 5MP depth sensor\r\nQualcomm Snapdragon 888 processor with 8GB RAM and 256GB storage\r\n5000mAh battery with 65W fast charging support\r\n5G connectivity with dual SIM capability\r\nIn-display fingerprint sensor and face unlock technology\r\nSleek glass and aluminum design with IP68 water and dust resistance', 'The Horizon X1 redefines mobile innovation with its stunning display, powerful performance, and advanced camera capabilities. Immerse yourself in vibrant visuals on the 6.5-inch Super AMOLED screen, while capturing every moment with clarity and detail usi', 'Horizon X1: 6.5\" Super AMOLED, Snapdragon 888, Triple Camera', 'Horizon X1, mobile phone, 6.5-inch display, Snapdragon 888, triple camera, 5G,', 'Experience the ultimate in mobile technology with the Horizon X1. Featuring a 6.5-inch Super AMOLED display, Snapdragon 888 processor, and triple-camera setup, it\'s designed to elevate your smartphone experience. Explore now!', './uploads/product-1.jpg', '', NULL, 0, 'horizon-x1', 10, '2024-04-30', '::1', NULL),
(2, 'Mbdjo7_2', '57670', 'AGNar7_1', 'Wjmnqz_4', 'Motorola G34 5G', 10999, 10500, 'flipkart', '2', 'Qualcomm Snapdragon 888 processor with 8GB RAM and 256GB storage\r\n5000mAh battery with 65W fast charging support\r\n5G connectivity with dual SIM capability\r\nIn-display fingerprint sensor and face unlock technology\r\nSleek glass and aluminum design with IP68 water and dust resistance', 'Motorola G34 5G redefines mobile innovation with its stunning display, powerful performance, and advanced camera capabilities. Immerse yourself in vibrant visuals on the 6.5-inch Super AMOLED screen, while capturing every moment with clarity and detail us', 'Motorola G34 5G Super AMOLED, Snapdragon 888, Triple Camera', 'Motorola G34 5G mobile phone, 6.5-inch display, Snapdragon 888, triple camera, 5G,', 'Experience the ultimate in mobile technology with the Motorola G34 5G Super. Featuring a 6.5-inch Super AMOLED display, Snapdragon 888 processor, and triple-camera setup, it\'s designed to elevate your smartphone experience. Explore now!', './uploads/product-5-3.jpg', '', NULL, 0, 'motorola-g34-5g', 12, '2024-04-30', '::1', NULL),
(3, 'DIPUkp_3', '15304', 'AGNar7_1', 'KLfos0_2', 'boAt Xtend Smartwatch', 2100, 1999, 'Boat', '1', 'Advanced health tracking including heart rate monitoring, sleep analysis, and step counting\r\nWater-resistant up to 50 meters, suitable for swimming and water sports\r\nHigh-resolution color touchscreen display with customizable watch faces\r\nGPS tracking for outdoor activities and route mapping\r\nLong battery life with up to 7 days of usage on a single charge\r\nBluetooth connectivity for notifications, calls, and music control\r\nDurable and stylish design suitable for both active and casual wear', 'Elevate your fitness and lifestyle with the boAt Xtend Smartwatch digital watch. Track your health and fitness goals with precision, monitor your heart rate, analyze your sleep patterns, and count your steps throughout the day. Whether you\'re hitting the ', 'boAt Xtend Smartwatch Advanced Health Tracking Digital Watch', 'boAt Xtend Smartwatch digital watch, health tracking, GPS, Bluetooth, fitness tracker, XYZ Tech', 'Stay connected and track your fitness goals with the boAt Xtend Smartwatch digital watch. Featuring advanced health tracking, GPS, and Bluetooth connectivity, it\'s the perfect companion for your active lifestyle. Explore now!', './uploads/product-8.jpg', '', NULL, 0, 'boat-xtend-smartwatch', 11, '2024-04-30', '::1', NULL),
(4, 'ABFMa2_4', '30878', 'JNnwz1_3', 'GOYhiv_5', 'Zebronics Zeb-Dynamic', 999, 699, 'Zebronics', '2', 'Immersive 7.1 surround sound for an unparalleled gaming experience\r\nNoise-canceling microphone with crystal-clear voice transmission\r\nLightweight and comfortable design for long gaming sessions\r\nRGB lighting customizable via dedicated software\r\nCompatible with PC, PlayStation, Xbox, and Nintendo Switch\r\nDetachable microphone for versatility in use\r\nDurable construction with premium materials for longevity', 'Step into the world of professional gaming audio with the SonicBlast 500X gaming headphones. Experience every detail of your games with immersive 7.1 surround sound, allowing you to pinpoint the direction of every sound effect and enemy footsteps. Communi', 'Zebronics Zeb-Dynamic  Gaming Headphones: 7.1 Surround Sound, RGB Lighting | XYZ Gaming', 'Zebronics Zeb-Dynamic gaming headphones, 7.1 surround sound, noise-canceling microphone, RGB lighting, gaming headset, XYZ Gaming', 'Elevate your gaming experience with theZebronics Zeb-Dynamic  gaming headphones. Featuring immersive 7.1 surround sound, noise-canceling microphone, and customizable RGB lighting, they\'re the perfect choice for gamers. Explore now!', './uploads/product-3.jpg', '', NULL, 0, 'zebronics-zeb-dynamic', 20, '2024-04-30', '::1', NULL),
(5, 'JNat16_5', '42120', 'JNnwz1_3', 'GOYhiv_5', 'Sony ZX110', 899, 799, 'Sony', '1', 'Immersive 7.1 surround sound for an unparalleled gaming experience\r\nNoise-canceling microphone with crystal-clear voice transmission\r\nLightweight and comfortable design for long gaming sessions\r\nRGB lighting customizable via dedicated software\r\nCompatible with PC, PlayStation, Xbox, and Nintendo Switch\r\nDetachable microphone for versatility in use\r\nDurable construction with premium materials for longevity', 'Step into the world of professional gaming audio with the Sony ZX110 gaming headphones. Experience every detail of your games with immersive 7.1 surround sound, allowing you to pinpoint the direction of every sound effect and enemy footsteps. Communicate ', 'Sony ZX110 Gaming Headphones: 7.1 Surround Sound, RGB Lighting | XYZ Gaming', 'Sony ZX110 gaming headphones, 7.1 surround sound, noise-canceling microphone, RGB lighting, gaming headset, XYZ Gaming', 'Elevate your gaming experience with the Sony ZX110 gaming headphones. Featuring immersive 7.1 surround sound, noise-canceling microphone, and customizable RGB lighting, they\'re the perfect choice for gamers. Explore now!', './uploads/product-10.jpg', '', NULL, 0, 'sony-zx110', 2, '2024-04-30', '::1', NULL),
(6, 'SXevy7_6', '12913', 'JNnwz1_3', 'GOYhiv_5', 'CLAW SM50', 2390, 2199, 'Bose', '2', 'Immersive 7.1 surround sound for an unparalleled gaming experience\r\nNoise-canceling microphone with crystal-clear voice transmission\r\nLightweight and comfortable design for long gaming sessions\r\nRGB lighting customizable via dedicated software\r\nCompatible with PC, PlayStation, Xbox, and Nintendo Switch\r\nDetachable microphone for versatility in use\r\nDurable construction with premium materials for longevity', 'Step into the world of professional gaming audio with the SonicBlast 500X gaming headphones. Experience every detail of your games with immersive 7.1 surround sound, allowing you to pinpoint the direction of every sound effect and enemy footsteps. Communi', 'CLAW SM50 Gaming Headphones: 7.1 Surround Sound, RGB Lighting | XYZ Gaming', 'CLAW SM50 gaming headphones, 7.1 surround sound, noise-canceling microphone, RGB lighting, gaming headset, XYZ Gaming', 'Elevate your gaming experience with the SonicBlast 500X gaming headphones. Featuring immersive 7.1 surround sound, noise-canceling microphone, and customizable RGB lighting, they\'re the perfect choice for gamers. Explore now!', './uploads/product-9.jpg', '', NULL, 0, 'claw-sm50', 15, '2024-04-30', '::1', NULL),
(7, 'GPbqy7_7', '64571', 'JNnwz1_3', 'GOYhiv_5', 'Hammer Bash 2.0', 2199, 1999, 'Hammer Bash', '1', 'Immersive 7.1 surround sound for an unparalleled gaming experience\r\nNoise-canceling microphone with crystal-clear voice transmission\r\nLightweight and comfortable design for long gaming sessions\r\nRGB lighting customizable via dedicated software\r\nCompatible with PC, PlayStation, Xbox, and Nintendo Switch\r\nDetachable microphone for versatility in use\r\nDurable construction with premium materials for longevity', 'Step into the world of professional gaming audio with the SonicBlast 500X gaming headphones. Experience every detail of your games with immersive 7.1 surround sound, allowing you to pinpoint the direction of every sound effect and enemy footsteps. Communi', 'Hammer Bash 2.0 Gaming Headphones: 7.1 Surround Sound, RGB Lighting | XYZ Gaming', 'Hammer Bash 2.0 gaming headphones, 7.1 surround sound, noise-canceling microphone, RGB lighting, gaming headset, XYZ Gaming', 'Elevate your gaming experience with the SonicBlast 500X gaming headphones. Featuring immersive 7.1 surround sound, noise-canceling microphone, and customizable RGB lighting, they\'re the perfect choice for gamers. Explore now!', './uploads/product-14.jpg', '', NULL, 0, 'hammer-bash-2-0', 8, '2024-04-30', '::1', NULL),
(8, 'FIQZgz_8', '40886', 'JNnwz1_3', 'GOYhiv_5', 'PTron Bassbuds Duo', 728, 720, 'PTron', '2', 'Immersive 7.1 surround sound for an unparalleled gaming experience\r\nNoise-canceling microphone with crystal-clear voice transmission\r\nLightweight and comfortable design for long gaming sessions\r\nRGB lighting customizable via dedicated software\r\nCompatible with PC, PlayStation, Xbox, and Nintendo Switch\r\nDetachable microphone for versatility in use\r\nDurable construction with premium materials for longevity', 'Step into the world of professional gaming audio with the SonicBlast 500X gaming headphones. Experience every detail of your games with immersive 7.1 surround sound, allowing you to pinpoint the direction of every sound effect and enemy footsteps. Communi', 'PTron Bassbuds Duo Gaming Headphones: 7.1 Surround Sound, RGB Lighting | XYZ Gaming', 'PTron Bassbuds Duo gaming headphones, 7.1 surround sound, noise-canceling microphone, RGB lighting, gaming headset, XYZ Gaming', 'Elevate your gaming experience with the SonicBlast 500X gaming headphones. Featuring immersive 7.1 surround sound, noise-canceling microphone, and customizable RGB lighting, they\'re the perfect choice for gamers. Explore now!', './uploads/product-offer-2.jpg', '', NULL, 0, 'ptron-bassbuds-duo', 19, '2024-04-30', '::1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ec_users`
--

CREATE TABLE `ec_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `phone` varchar(80) DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_users`
--

INSERT INTO `ec_users` (`id`, `user_id`, `phone`, `user_image`, `username`, `email`, `password`, `status`, `ip`, `added_on`, `updated_on`) VALUES
(1, 'U23CDil12_1', '8905648522', './uploads/user-11.jpg', 'Pramod Kumar Saini', 'pramod@gmail.com', '123', 0, '::1', '2024-04-30', '');

-- --------------------------------------------------------

--
-- Table structure for table `ec_wishlist`
--

CREATE TABLE `ec_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `wishlist_id` varchar(30) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `added_on` varchar(30) NOT NULL,
  `updated_on` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ec_wishlist`
--

INSERT INTO `ec_wishlist` (`id`, `user_id`, `wishlist_id`, `product_id`, `product_name`, `product_price`, `slug`, `product_image`, `added_on`, `updated_on`) VALUES
(1, 'U23CDil12_1', 'W23COdpy1_1', '40886', 'PTron Bassbuds Duo', '720', 'ptron-bassbuds-duo', './uploads/product-offer-2.jpg', '2024-04-30', ''),
(2, 'U23CDil12_1', 'W23DZcijo_2', '42120', 'Sony ZX110', '799', 'sony-zx110', './uploads/product-10.jpg', '2024-04-30', ''),
(3, 'U23CDil12_1', 'W23Ydjkrx_3', '12913', 'CLAW SM50', '2199', 'claw-sm50', './uploads/product-9.jpg', '2024-05-02', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ec_banner`
--
ALTER TABLE `ec_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_cart`
--
ALTER TABLE `ec_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_category`
--
ALTER TABLE `ec_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_product`
--
ALTER TABLE `ec_product`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
