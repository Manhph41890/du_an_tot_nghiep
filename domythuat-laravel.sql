-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 11, 2024 lúc 06:24 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `domythuat-laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anh_san_phams`
--

CREATE TABLE `anh_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `san_pham_id` bigint UNSIGNED NOT NULL,
  `anh_san_pham` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bai_viets`
--

CREATE TABLE `bai_viets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tieu_de_bai_viet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_bai_viet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_dang` date NOT NULL,
  `noi_dung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bien_the_san_phams`
--

CREATE TABLE `bien_the_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `san_pham_id` bigint UNSIGNED NOT NULL,
  `size_san_pham_id` bigint UNSIGNED NOT NULL,
  `color_san_pham_id` bigint UNSIGNED NOT NULL,
  `anh_bien_the` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_luong` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `don_hang_id` bigint UNSIGNED NOT NULL,
  `so_luong` int NOT NULL,
  `gia_tien` decimal(8,2) NOT NULL,
  `thanh_tien` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_chuc_vu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta_chuc_vu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `color_san_phams`
--

CREATE TABLE `color_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gias`
--

CREATE TABLE `danh_gias` (
  `id` bigint UNSIGNED NOT NULL,
  `san_pham_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ngay_danh_gia` date NOT NULL,
  `diem_so` int NOT NULL,
  `binh_luan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_danh_muc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_danh_muc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `san_pham_id` bigint UNSIGNED NOT NULL,
  `khuyen_mai_id` bigint UNSIGNED NOT NULL,
  `phuong_thuc_thanh_toan_id` bigint UNSIGNED NOT NULL,
  `phuong_thuc_van_chuyen_id` bigint UNSIGNED NOT NULL,
  `ngay_tao` date NOT NULL,
  `tong_tien` decimal(8,2) NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` enum('Đặt hàng thành công','Đang chuẩn bị hàng','Đang vận chuyển','Đã giao') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mais`
--

CREATE TABLE `khuyen_mais` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_khuyen_mai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_khuyen_mai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_tri_khuyen_mai` decimal(8,2) NOT NULL,
  `so_luong_ma` int NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_09_11_152555_create_chuc_vus_table', 1),
(2, '2024_09_11_152326_create_danh_mucs_table', 2),
(3, '2024_09_11_152939_create_phuong_thuc_van_chuyens_table', 3),
(4, '2024_09_11_152958_create_phuong_thuc_thanh_toans_table', 4),
(5, '2024_09_11_152703_create_khuyen_mais_table', 5),
(6, '2024_09_11_162333_create_size_san_phams_table', 6),
(7, '2024_09_11_162306_create_color_san_phams_table', 7),
(8, '2014_10_12_000000_create_users_table', 8),
(9, '2014_10_12_100000_create_password_reset_tokens_table', 8),
(10, '2019_08_19_000000_create_failed_jobs_table', 8),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 8),
(12, '2024_09_11_152432_create_san_phams_table', 8),
(13, '2024_09_11_152647_create_bai_viets_table', 8),
(14, '2024_09_11_152716_create_danh_gias_table', 8),
(17, '2024_09_11_162355_create_anh_san_phams_table', 8),
(18, '2024_09_11_162450_create_bien_the_san_phams_table', 9),
(19, '2024_09_11_152913_create_don_hangs_table', 10),
(21, '2024_09_11_153206_create_chi_tiet_don_hangs_table', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` bigint UNSIGNED NOT NULL,
  `kieu_thanh_toan` enum('Thanh toán online','Thanh toán khi nhận hàng') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_van_chuyens`
--

CREATE TABLE `phuong_thuc_van_chuyens` (
  `id` bigint UNSIGNED NOT NULL,
  `kieu_van_chuyen` enum('Giao hàng hỏa tốc','Giao hàng thường') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `danh_muc_id` bigint UNSIGNED NOT NULL,
  `ten_san_pham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_goc` decimal(8,2) NOT NULL,
  `gia_km` decimal(8,2) NOT NULL,
  `anh_san_pham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int NOT NULL,
  `ma_ta_san_pham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size_san_phams`
--

CREATE TABLE `size_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `chuc_vu_id` bigint UNSIGNED NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anh_san_phams_san_pham_id_foreign` (`san_pham_id`);

--
-- Chỉ mục cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bai_viets_tieu_de_bai_viet_unique` (`tieu_de_bai_viet`),
  ADD KEY `bai_viets_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bien_the_san_pham_unique` (`san_pham_id`,`size_san_pham_id`,`color_san_pham_id`),
  ADD KEY `bien_the_san_phams_size_san_pham_id_foreign` (`size_san_pham_id`),
  ADD KEY `bien_the_san_phams_color_san_pham_id_foreign` (`color_san_pham_id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_don_hangs_don_hang_id_foreign` (`don_hang_id`);

--
-- Chỉ mục cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chuc_vus_ten_chuc_vu_unique` (`ten_chuc_vu`);

--
-- Chỉ mục cho bảng `color_san_phams`
--
ALTER TABLE `color_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_san_phams_ten_color_unique` (`ten_color`);

--
-- Chỉ mục cho bảng `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_gias_san_pham_id_foreign` (`san_pham_id`),
  ADD KEY `danh_gias_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `danh_mucs_ten_danh_muc_unique` (`ten_danh_muc`);

--
-- Chỉ mục cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hangs_user_id_foreign` (`user_id`),
  ADD KEY `don_hangs_san_pham_id_foreign` (`san_pham_id`),
  ADD KEY `don_hangs_khuyen_mai_id_foreign` (`khuyen_mai_id`),
  ADD KEY `don_hangs_phuong_thuc_thanh_toan_id_foreign` (`phuong_thuc_thanh_toan_id`),
  ADD KEY `don_hangs_phuong_thuc_van_chuyen_id_foreign` (`phuong_thuc_van_chuyen_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khuyen_mais_ma_khuyen_mai_unique` (`ma_khuyen_mai`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phuong_thuc_van_chuyens`
--
ALTER TABLE `phuong_thuc_van_chuyens`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_phams_danh_muc_id_foreign` (`danh_muc_id`);

--
-- Chỉ mục cho bảng `size_san_phams`
--
ALTER TABLE `size_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `size_san_phams_ten_size_unique` (`ten_size`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_chuc_vu_id_foreign` (`chuc_vu_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `color_san_phams`
--
ALTER TABLE `color_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_gias`
--
ALTER TABLE `danh_gias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_van_chuyens`
--
ALTER TABLE `phuong_thuc_van_chuyens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `size_san_phams`
--
ALTER TABLE `size_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD CONSTRAINT `anh_san_phams_san_pham_id_foreign` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `bai_viets`
--
ALTER TABLE `bai_viets`
  ADD CONSTRAINT `bai_viets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD CONSTRAINT `bien_the_san_phams_color_san_pham_id_foreign` FOREIGN KEY (`color_san_pham_id`) REFERENCES `color_san_phams` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_san_pham_id_foreign` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_size_san_pham_id_foreign` FOREIGN KEY (`size_san_pham_id`) REFERENCES `size_san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_don_hang_id_foreign` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hangs` (`id`);

--
-- Các ràng buộc cho bảng `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD CONSTRAINT `danh_gias_san_pham_id_foreign` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `danh_gias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `don_hangs_khuyen_mai_id_foreign` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `khuyen_mais` (`id`),
  ADD CONSTRAINT `don_hangs_phuong_thuc_thanh_toan_id_foreign` FOREIGN KEY (`phuong_thuc_thanh_toan_id`) REFERENCES `phuong_thuc_thanh_toans` (`id`),
  ADD CONSTRAINT `don_hangs_phuong_thuc_van_chuyen_id_foreign` FOREIGN KEY (`phuong_thuc_van_chuyen_id`) REFERENCES `phuong_thuc_van_chuyens` (`id`),
  ADD CONSTRAINT `don_hangs_san_pham_id_foreign` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `don_hangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_danh_muc_id_foreign` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_chuc_vu_id_foreign` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
