-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 25, 2024 lúc 03:34 PM
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
-- Cơ sở dữ liệu: `dbtravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbdattour`
--

CREATE TABLE `tbdattour` (
  `madattour` int(6) NOT NULL,
  `matour` int(6) NOT NULL,
  `tenkhachhang` varchar(255) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `ngaydat` date NOT NULL DEFAULT current_timestamp(),
  `soluongnguoi` int(4) NOT NULL,
  `thongtinphong` text NOT NULL,
  `xacnhandattour` tinyint(1) NOT NULL,
  `xacnhanthanhtoan` tinyint(1) NOT NULL,
  `xacnhanditour` tinyint(1) NOT NULL,
  `ngayditour` date NOT NULL,
  `ngayvetour` date NOT NULL,
  `phanhoicuakhach` text NOT NULL,
  `coc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbdattour`
--

INSERT INTO `tbdattour` (`madattour`, `matour`, `tenkhachhang`, `sodienthoai`, `ngaydat`, `soluongnguoi`, `thongtinphong`, `xacnhandattour`, `xacnhanthanhtoan`, `xacnhanditour`, `ngayditour`, `ngayvetour`, `phanhoicuakhach`, `coc`) VALUES
(1, 1, 'Quách Đức Duy', '0363273201', '2024-01-19', 2, '1 phòng đơn', 0, 0, 0, '2024-01-18', '2024-01-24', 'Gia đình mình đã sử dụng dịch vụ du lịch ở rất nhiều nơi, nhưng với VIETNAM-NATURE mình và gia đình luôn cảm thấy yên tâm nhất về chất lượng dịch vụ, cũng như chế độ chăm sóc tận tình  trong suốt hành trình, mình sẽ giới thiệu bạn bè tham gia và sử dụng dịch vụ du lịch vủa công ty. Nếu bạn chưa thử hay thử ngay và gửi phản hồi nhé, xem bạn có giống như mình không.', 1536000000),
(4, 1, 'Nguyễn Văn A', '0123456789', '2024-01-14', 3, '1 đơn', 0, 1, 1, '2024-01-12', '2024-01-13', 'Thật sự mình thấy VIETNAM-NATURE luôn đem đến cho khách hàng sự yên tâm về cả chi phí du lịch luôn, các tour trong nước rất rẻ mà vẫn đảm bảo được các tiêu chí đầy đủ, chất lượng phục vụ thì quá tuyệt vời, từ khi sử dụng dịch vụ thành ra chẳng muốn sử dụng dịch vụ của bên nào nữa, quá tốt so với quy định. Tham gia và hưởng ưu đãi mối tuần luôn.', 12000000),
(36, 5, 'Nguyễn Văn B', '0123456789', '2024-01-12', 2, '1 đơn', 1, 1, 1, '2024-01-14', '2024-01-22', 'Tuyệt vời lắm', 4800),
(44, 5, 'Nguyễn Văn C', '0321155444', '2024-01-12', 3, '1 đơn', 0, 1, 1, '2024-01-26', '2024-01-26', 'Nhân viên rất thân thiện tour rất tuyệt vời', 120000),
(46, 7, 'Phạm Văn Nam', '09856231', '2024-01-19', 2, '2 phòng đơn', 0, 0, 0, '2024-01-20', '2024-01-23', 'Quá là rẻ', 6000000),
(49, 5, 'Trần Văn Trường', '5243523465', '2024-01-19', 3, '1 phòng đôi 1 đơn', 0, 1, 0, '2024-01-25', '0000-00-00', '', 0),
(50, 1, 'Tiến Đạt', '5243523465', '2024-01-23', 3, '1 phòng đôi 1 đơn', 0, 0, 0, '2024-01-24', '0000-00-00', '', 0);

--
-- Bẫy `tbdattour`
--
DELIMITER $$
CREATE TRIGGER `tbdattour_before_insert` BEFORE INSERT ON `tbdattour` FOR EACH ROW BEGIN
  IF NEW.soluongnguoi > 1 THEN
    SET NEW.coc = NEW.coc * 2;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tbdattour_before_update` BEFORE UPDATE ON `tbdattour` FOR EACH ROW BEGIN
  IF NEW.soluongnguoi > 1 THEN
    SET NEW.coc = NEW.coc * 2;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbdiadiem`
--

CREATE TABLE `tbdiadiem` (
  `madiadiem` int(6) NOT NULL,
  `tendiadiem` varchar(255) NOT NULL,
  `mota` text NOT NULL,
  `hinhanh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbdiadiem`
--

INSERT INTO `tbdiadiem` (`madiadiem`, `tendiadiem`, `mota`, `hinhanh`) VALUES
(1, 'Hà Nội', 'Di tích lịch sử như Hoàng thành Thăng Long và nhà thờ Lớn. Lễ hội truyền thống và nghệ thuật đặc sắc. Ẩm thực: Phở, bún chả, và các món ngon độc đáo. Quán cà phê phố cổ và quán hàng rong. Cuộc sống đô thị: Giao thông sôi động và đời sống xã hội đa dạng. Chợ địa phương và thương xá.', 'hanoi.jpg'),
(2, 'Nha Trang', 'Nha Trang là một thành phố du lịch biển nổi danh từ lâu của Việt Nam, nằm tại tỉnh Khánh Hòa. Thành phố có vị trí thuận lợi về giao thông và khí hậu ôn hòa, tạo nên những bãi biển đẹp - như bãi biển Cam Ranh, tứ Bình, hòn Mun, hòn Tằm, hòn Miễu, hòn Một, đảo Yến – Hòn Nội, biển Nha Trang, đảo Điệp Sơn,...', 'nhatrang.jpg'),
(4, 'Đà Lạt', 'Đà Lạt là một thành phố thân thiện, dễ gần và mến khách, điều này làm cho du khách yêu thích đến thăm đất nước này. Sống trong một khung cảnh tuyệt đẹp, với không khí trong lành và mát mẻ, người dân ở đây tỏ ra thông thái, hiền hoà và chân thật.', 'dalat.jpg'),
(5, 'Phú Quốc', 'Phú Quốc có nhiều bãi biển đẹp trải dài từ phía bắc đến phía nam, có 99 ngọn núi đồi và dãy rừng nguyên sinh với hệ động thực vật phong phú. Phía Bắc của đảo có làng chài Rạch Vẹm, Bãi Thơm, Hòn Một,… nổi bật với vẻ đẹp hoang sơ hay ở Nam Đảo có 12 hòn đảo nhỏ to khác nhau thuộc quần đảo An Thới có thể kể đến như Hòn Thơm, Hòn Móng Tay, Hòn Gầm Ghì, Hòn Mây Rút,… là những nơi lý tưởng cho các hoạt động khám phá thiên nhiên cùng các hoạt động trên biển như du thuyền, câu cá, lặn ngắm san hô và khám phá đảo hoang kỳ thú…', 'phuquoc.jpg'),
(6, 'Hồ Chí Minh', 'Du lịch Hồ Chí Minh mang đến cho du khách một cơ hội để khám phá không chỉ về lịch sử và văn hóa, mà còn về đời sống đô thị sôi động và ẩm thực phong phú. ', 'hochiminh.jpg'),
(7, 'Cần thơ', 'Cần Thơ là một thành phố thuộc tỉnh Cần Thơ cũ và là tỉnh lỵ của tỉnh Cần Thơ trước khi thành lập thành phố Cần Thơ trực thuộc trung ương ngày nay. Thành phố Cần Thơ lúc bấy giờ có địa giới hành chính tương ứng với các quận Ninh Kiều, Bình Thủy, một phần quận Cái Răng và một phần huyện Phong Điền ngày nay.', 'cantho.jpg'),
(8, ' Thiền Viện Phương Nam', 'Thiền viện Trúc Lâm Phương Nam tọa lạc tại ấp Mỹ Nhơn, xã Mỹ Khánh, huyện Phong Điền, thành phố Cần Thơ, Việt Nam. Đây là một thiền viện thuộc hàng lớn nhất ở miền Tây Nam Bộ, tính đến thời điểm năm 2014. Thiền viện được khởi công xây dựng vào ngày 16 tháng 7 năm 2013, trên một diện tích 38.016 m².', 'thienvienphuongnam.jpg'),
(9, 'Yên tử', 'Yên Tử là một dãy núi trải dài trên địa bàn 3 tỉnh Quảng Ninh, Bắc Giang, Hải Dương và cũng là tên ngọn núi cao nhất trong dãy. Đây là dãy núi gắn liền với nhà Trần trong lịch sử Việt Nam cũng như gắn với Thiền phái Trúc Lâm.', 'yentu.jpg'),
(10, 'Lào cai', 'Đẹp', 'laocai.jpg'),
(11, 'Sapa', 'đẹp', 'sapa.jpg'),
(12, 'Hạ Long', 'quá đẹp', 'halong.jpg'),
(13, 'Thiền Viện Trúc Lâm Hộ Quốc', 'Đẹp', 'thienvientruclamhoquoc.jpg'),
(16, 'Cửa lò', 'Siêu đệp', 'cualo.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbhanhtrinhtour`
--

CREATE TABLE `tbhanhtrinhtour` (
  `matour` int(6) NOT NULL,
  `madiadiem` int(6) NOT NULL,
  `tendiadiem` varchar(255) NOT NULL,
  `thutu` int(11) NOT NULL,
  `mahanhtrinh` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbhanhtrinhtour`
--

INSERT INTO `tbhanhtrinhtour` (`matour`, `madiadiem`, `tendiadiem`, `thutu`, `mahanhtrinh`) VALUES
(1, 2, 'Nha Trang', 3, 2),
(6, 5, 'Phú Quốc', 1, 11),
(6, 13, 'Thiền Viện Trúc Lâm Hộ Quốc', 2, 12),
(1, 1, 'Hà Nội', 1, 16),
(1, 4, 'Đà Lạt', 3, 17),
(4, 6, 'Hồ Chí Minh', 1, 18),
(4, 5, 'Phú Quốc', 2, 19),
(5, 1, 'Hà Nội', 1, 20),
(1, 7, 'Cần Thơ', 2, 21),
(5, 8, 'Thiền Viện Phương Nam', 3, 22),
(5, 7, 'Cần Thơ', 2, 23),
(7, 1, 'Hà Nội', 1, 24),
(7, 10, 'Lào Cai', 2, 25),
(7, 11, 'SaPa', 3, 26),
(7, 9, 'Yên Tử', 4, 27),
(7, 12, 'Hạ Long', 5, 28);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbnguoidung`
--

CREATE TABLE `tbnguoidung` (
  `manguoidung` int(6) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `quyentruycap` varchar(50) NOT NULL,
  `ngaydangky` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbnguoidung`
--

INSERT INTO `tbnguoidung` (`manguoidung`, `matkhau`, `hoten`, `email`, `quyentruycap`, `ngaydangky`) VALUES
(6, '12345678', 'Trần Văn Trường', 'truongday@gmail.com', 'Nhân Viên', '2024-01-05 12:28:28'),
(8, 'admin123', 'Quách Đức Duy', 'admin@gmail.com', 'Quản Lý', '2024-01-11 01:59:59'),
(9, '12345678', 'Phạm Văn Nam', 'nam@gmail.com', 'Nhân Viên', '2024-01-18 14:04:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbthanhtoan`
--

CREATE TABLE `tbthanhtoan` (
  `mathanhtoan` int(6) NOT NULL,
  `madattour` int(6) NOT NULL,
  `tenkhachhang` varchar(255) NOT NULL,
  `ngaythanhtoan` date NOT NULL,
  `sotien` float NOT NULL,
  `phuongthucthanhtoan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbthanhtoan`
--

INSERT INTO `tbthanhtoan` (`mathanhtoan`, `madattour`, `tenkhachhang`, `ngaythanhtoan`, `sotien`, `phuongthucthanhtoan`) VALUES
(17, 1, 'Quách Đức Duy', '2024-01-19', 20000000, 'Tiền Mặt'),
(20, 49, 'Trần Văn Trường', '2024-01-19', 8700000, 'Tiền Mặt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbtourdulich`
--

CREATE TABLE `tbtourdulich` (
  `matour` int(6) NOT NULL,
  `tentour` varchar(255) NOT NULL,
  `gia` float NOT NULL,
  `mota` text NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbtourdulich`
--

INSERT INTO `tbtourdulich` (`matour`, `tentour`, `gia`, `mota`, `ngaybatdau`, `ngayketthuc`) VALUES
(1, 'Thành phố Hà Nội-Bãi biển Nha Trang- Thành phố Đà Lạt', 5000000, 'Đẹp', '2024-01-03', '2024-01-18'),
(4, 'Thành phố Hồ Chí Minh- Đảo Phú Quốc', 10000000, 'Đi sướng lắm', '2024-01-18', '2024-01-24'),
(5, 'Hà Nội - Cần Thơ - Thiền Viện Phương Nam', 2900000, 'Đẹp', '2024-01-09', '2024-01-13'),
(6, ' Phú Quốc - Thiền Viện Trúc Lâm Hộ Quốc', 2000000, 'Đẹp', '2024-01-24', '2024-01-28'),
(7, 'Hà Nội - Lào Cai - Sapa- Yên Tử - Hạ Long', 8000000, 'Đẹp', '2024-01-17', '2024-01-23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbdattour`
--
ALTER TABLE `tbdattour`
  ADD PRIMARY KEY (`madattour`),
  ADD KEY `FK_madiadiem_tbdattour` (`matour`);

--
-- Chỉ mục cho bảng `tbdiadiem`
--
ALTER TABLE `tbdiadiem`
  ADD PRIMARY KEY (`madiadiem`);

--
-- Chỉ mục cho bảng `tbhanhtrinhtour`
--
ALTER TABLE `tbhanhtrinhtour`
  ADD PRIMARY KEY (`mahanhtrinh`),
  ADD KEY `FK_madiadiem_tbhanhtrinhtour` (`madiadiem`),
  ADD KEY `FK_matour_tbhanhtrinhtour` (`matour`);

--
-- Chỉ mục cho bảng `tbnguoidung`
--
ALTER TABLE `tbnguoidung`
  ADD PRIMARY KEY (`manguoidung`);

--
-- Chỉ mục cho bảng `tbthanhtoan`
--
ALTER TABLE `tbthanhtoan`
  ADD PRIMARY KEY (`mathanhtoan`),
  ADD KEY `FK_matdattour` (`madattour`);

--
-- Chỉ mục cho bảng `tbtourdulich`
--
ALTER TABLE `tbtourdulich`
  ADD PRIMARY KEY (`matour`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbdattour`
--
ALTER TABLE `tbdattour`
  MODIFY `madattour` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `tbdiadiem`
--
ALTER TABLE `tbdiadiem`
  MODIFY `madiadiem` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbhanhtrinhtour`
--
ALTER TABLE `tbhanhtrinhtour`
  MODIFY `mahanhtrinh` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `tbnguoidung`
--
ALTER TABLE `tbnguoidung`
  MODIFY `manguoidung` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbthanhtoan`
--
ALTER TABLE `tbthanhtoan`
  MODIFY `mathanhtoan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbtourdulich`
--
ALTER TABLE `tbtourdulich`
  MODIFY `matour` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbdattour`
--
ALTER TABLE `tbdattour`
  ADD CONSTRAINT `FK_tour_tbdattour` FOREIGN KEY (`matour`) REFERENCES `tbtourdulich` (`matour`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbhanhtrinhtour`
--
ALTER TABLE `tbhanhtrinhtour`
  ADD CONSTRAINT `FK_madiadiem_tbhanhtrinhtour` FOREIGN KEY (`madiadiem`) REFERENCES `tbdiadiem` (`madiadiem`),
  ADD CONSTRAINT `FK_matour_tbhanhtrinhtour` FOREIGN KEY (`matour`) REFERENCES `tbtourdulich` (`matour`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbthanhtoan`
--
ALTER TABLE `tbthanhtoan`
  ADD CONSTRAINT `FK_madattour_tbthanhtoan` FOREIGN KEY (`madattour`) REFERENCES `tbdattour` (`madattour`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
