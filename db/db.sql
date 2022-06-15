-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 08, 2022 lúc 06:50 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `username` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `role` int(11) NOT NULL,
  `id_user` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `fname` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `id_department` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `position` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `images` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`username`, `password`, `role`, `id_user`, `fname`, `id_department`, `position`, `images`) VALUES
('admin', '123456', 2, '', 'Admin', 'D000', 'head', NULL),
('adp123', '123456', 0, 'U021', 'Ada Phoebe', 'D005', 'employee', NULL),
('af123', '123456', 0, 'U024', 'Ada Freya', 'D005', 'emloyee', NULL),
('ai123', '123456', 1, 'U007', 'Alice Isabella', 'D002', 'head', NULL),
('al123', '123456', 0, 'U009', 'Annie Lily', 'D002', 'emloyee', NULL),
('ap123', '123456', 0, 'U005', 'Ann Poppy', 'D001', 'emloyee', NULL),
('cc123', '123456', 0, 'U019', 'Catherine Chloe', 'D004', 'emloyee', NULL),
('di123', '123456', 0, 'U018', 'Dorothy Isabelle', 'D004', 'emloyee', NULL),
('ed123', '123456', 0, 'U023', 'Elisie Daisy', 'D005', 'emloyee', NULL),
('ee123', '123456', 0, 'U014', 'Eliza Evie', 'D003', 'emloyee', NULL),
('eg123', '123456', 0, 'U011', 'Emma Grace', 'D003', 'employee', NULL),
('ej123', '123456', 0, 'U008', 'Elien Jessica', 'D002', 'emloyee', NULL),
('em123', '123456', 0, 'U013', 'Emily Mia', 'D003', 'employee', NULL),
('eo123', '123456', 0, 'U002', 'Elizabeth Olivia', 'D001', 'emloyee', NULL),
('es123', '123456', 0, 'U012', 'Edith Sophia', 'D003', 'emloyee', NULL),
('esi123', '123456', 1, 'U020', 'Erthel Sienna', 'D004', 'head', NULL),
('fc123', '123456', 0, 'U022', 'Frances Charlotte', 'D005', 'emloyee', NULL),
('fs123', '123456', 0, 'U010', 'FLorence Sophie', 'D002', 'emloyee', NULL),
('gj123', '123456', 0, 'U028', 'George Jacob', 'D006', 'emloyee', NULL),
('ha123', '123456', 0, 'U025', 'Harriet Alice', 'D005', 'emloyee', NULL),
('hr123', '123456', 0, 'U015', 'Hannah Ruby', 'D003', 'emloyee', NULL),
('ja123', '123456', 1, 'U006', 'Jane Ava', 'D002', 'head', NULL),
('jc', '123456', 0, 'U029', 'James Charlie', 'D006', 'emloyee', NULL),
('jo123', '123456', 1, 'U026', 'john Oviler', 'D006', 'head', NULL),
('ma123', '123456', 0, 'U001', 'Mary Amelia', 'D001', 'employee', NULL),
('me123', '123456', 0, 'U004', 'Margaret Emily', 'D001', 'emloyee', NULL),
('ms123', '123456', 0, 'U017', 'Martha Scarlett', 'D004', 'emloyee', NULL),
('rt123', '123456', 0, 'U030', 'Robert Thomas', 'D006', 'emloyee', NULL),
('se123', '123456', 1, 'U016', 'Susan Ella', 'D004', 'head', NULL),
('si123', '123456', 0, 'U003', 'Sarah Isla', 'D001', 'emloyee', NULL),
('th123', '123456', 1, 'U027', 'Thomas Harry', 'D006', 'head', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `department`
--

CREATE TABLE `department` (
  `id_department` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `department`
--

INSERT INTO `department` (`id_department`, `name`) VALUES
('D000', 'Administration'),
('D001', 'Marketing'),
('D002', 'Human resources'),
('D003', 'Sales'),
('D004', 'Designing'),
('D005', 'Production'),
('D006', 'Packaging');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leave_app`
--

CREATE TABLE `leave_app` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `num_off` int(11) DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `file` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `leave_app`
--

INSERT INTO `leave_app` (`id`, `username`, `num_off`, `reason`, `file`, `status`) VALUES
(1, 'ma123', 1, 'i am sick', NULL, 2),
(2, 'ja123', 2, 'i am sick', NULL, 1),
(3, 'ma123', 2, 'i am headache', NULL, 1),
(4, 'ai123', 2, 'i am headache', NULL, 1),
(5, 'admin', 3, 'sick enough to die', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lib_num_off`
--

CREATE TABLE `lib_num_off` (
  `id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `num_off` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `lib_num_off`
--

INSERT INTO `lib_num_off` (`id`, `position`, `num_off`) VALUES
(1, 'employee', 12),
(2, 'head', 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ename` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `deadline` date NOT NULL,
  `progress` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `detail` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ework` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `file` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `tname` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `task`
--

INSERT INTO `task` (`id`, `username`, `ename`, `deadline`, `progress`, `detail`, `ework`, `file`, `tname`) VALUES
(3, 'ja123', 'Mary Amelia', '2022-01-15', '', 'ssss', '', NULL, 'Packing Product'),
(4, 'ai123', 'George Jacob', '2022-01-12', '', 'vvvvvv', '', NULL, 'Buy Suger');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_department` (`id_department`);

--
-- Chỉ mục cho bảng `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`);

--
-- Chỉ mục cho bảng `leave_app`
--
ALTER TABLE `leave_app`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `lib_num_off`
--
ALTER TABLE `lib_num_off`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `leave_app`
--
ALTER TABLE `leave_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `lib_num_off`
--
ALTER TABLE `lib_num_off`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`id_department`) REFERENCES `department` (`id_department`);

--
-- Các ràng buộc cho bảng `leave_app`
--
ALTER TABLE `leave_app`
  ADD CONSTRAINT `leave_app_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);

--
-- Các ràng buộc cho bảng `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
