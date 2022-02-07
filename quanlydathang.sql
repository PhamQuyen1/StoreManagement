-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 07, 2021 lúc 03:11 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydathang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `sodondh` int(11) NOT NULL,
  `mshh` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giadathang` double NOT NULL,
  `giamgia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`sodondh`, `mshh`, `soluong`, `giadathang`, `giamgia`) VALUES
(1, 1, 5, 700000, 0),
(1, 2, 2, 500000, 0),
(2, 19, 3, 4000000, 0),
(41, 11, 5, 1600000, 0),
(42, 15, 1, 3990000, 0),
(43, 17, 2, 8500000, 0);

--
-- Bẫy `chitietdathang`
--
DELIMITER $$
CREATE TRIGGER `insert_soluong_chitietdathang` AFTER INSERT ON `chitietdathang` FOR EACH ROW BEGIN
	if EXISTS(select * from hanghoa hh join chitietdathang ct on ct.mshh = hh.mshh where ct.soluong > hh.soluonghang ORDER by ct.sodondh, ct.mshh limit 1) then BEGIN
    DELETE from chitietdathang order by sodondh, mshh desc LIMIT 1;
    end;
    else BEGIN
    	update hanghoa set soluonghang = soluonghang - new.soluong where mshh = new.mshh;
    end;
    end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_soluong` AFTER UPDATE ON `chitietdathang` FOR EACH ROW BEGIN
	update hanghoa set soluonghang = soluonghang -(new.soluong - old.soluong);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `sodondh` int(11) NOT NULL,
  `mskh` int(11) NOT NULL,
  `msnv` int(11) NOT NULL,
  `ngaydh` datetime NOT NULL,
  `ngaygh` datetime NOT NULL,
  `trangthai` varchar(30) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`sodondh`, `mskh`, `msnv`, `ngaydh`, `ngaygh`, `trangthai`) VALUES
(1, 2, 1, '2021-05-28 20:00:58', '2021-06-14 19:41:14', '0'),
(2, 1, 1, '2021-05-28 20:00:58', '2021-06-14 19:37:35', '2'),
(41, 57, 1, '2021-05-28 20:00:58', '2021-06-14 19:37:31', '1'),
(42, 60, 1, '2021-06-07 14:38:56', '2021-06-07 14:38:56', '0'),
(43, 58, 1, '2021-06-07 14:38:57', '2021-06-07 14:38:57', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `madc` int(11) NOT NULL,
  `diachi` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `mskh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`madc`, `diachi`, `mskh`) VALUES
(1, 'Vĩnh Long', 1),
(2, 'TP HCM', 2),
(47, 'Phu Nhuan, TpHCM', 55),
(48, 'Ninh Kieu, Can Tho', 56),
(49, '123/45 Lê Lợi - Đà Lạt', 57),
(50, '125 Trần Phú , Cần Thơ', 58),
(51, '23 Cách Mạng Tháng 8, Cần Thơ', 59),
(52, '30/4, Can Tho', 60),
(53, '123/45 Lê Lợi - TpHCM', 61),
(54, 'TPHCM', 62),
(55, '125 Trần Phú , Cần Thơ', 63),
(56, '123/45 Lê Lợi - TpHCM', 64);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `mshh` int(11) NOT NULL,
  `tenhh` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `quycach` varchar(1000) COLLATE utf8_vietnamese_ci NOT NULL,
  `gia` double NOT NULL,
  `soluonghang` int(11) NOT NULL,
  `maloaihang` int(11) NOT NULL,
  `ghichu` text COLLATE utf8_vietnamese_ci NOT NULL,
  `hinhanh` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`mshh`, `tenhh`, `quycach`, `gia`, `soluonghang`, `maloaihang`, `ghichu`, `hinhanh`) VALUES
(1, 'Bàn ăn gỗ', 'Nếu bạn đang muốn tìm kiếm một bộ bàn ăn từ gỗ tự nhiên thân thiện khi sử dụng thì bộ bàn ăn gỗ tự nhiên thiết kế đẹp hiện đại là một lựa chọn không thể bỏ sót tại Bella Casa. Với phong cách thiết kế hiện đại, đường nét  tối giản, bộ bàn ăn gỗ tự nhiên mang đến người dùng một góc ăn uống vô cùng gọn gàng, đầm ấm.', 1100000, 100, 1, '', 'ban1.png'),
(2, 'Giường ngủ cao cấp', 'Sẽ rất tiếc nuối nếu bạn bỏ lỡ mẫu giường ngủ gia đình phong cách hiện đại khi đến Go Home mua sắm đồ nội thất cho gia đình. Bên cạnh các sản phẩm như bàn trà, kệ tivi, tủ giày thì giường ngủ gia đình cũng là dòng sản phẩm được nhiều khách hàng chọn mua tại Bella Casa.', 2000000, 20, 5, '', 'giuong1.png'),
(3, 'Bàn ăn gỗ cao cấp', 'Nếu bạn đang muốn tìm kiếm một bộ bàn ăn từ gỗ tự nhiên thân thiện khi sử dụng thì bộ bàn ăn gỗ tự nhiên thiết kế đẹp hiện đại là một lựa chọn không thể bỏ sót tại Bella Casa. Với phong cách thiết kế hiện đại, đường nét  tối giản, bộ bàn ăn gỗ tự nhiên mang đến người dùng một góc ăn uống vô cùng gọn gàng, đầm ấm.', 1500000, 180, 1, '', 'ban2.jpg'),
(4, 'Giường ngủ gỗ', 'Sẽ rất tiếc nuối nếu bạn bỏ lỡ mẫu giường ngủ gia đình phong cách hiện đại khi đến Go Home mua sắm đồ nội thất cho gia đình. Bên cạnh các sản phẩm như bàn trà, kệ tivi, tủ giày thì giường ngủ gia đình cũng là dòng sản phẩm được nhiều khách hàng chọn mua tại Bella Casa.', 2500000, 55, 5, '', 'giuong3.jpg'),
(5, 'Bàn gỗ nhỏ', 'Nếu bạn đang muốn tìm kiếm một bộ bàn ăn từ gỗ tự nhiên thân thiện khi sử dụng thì bộ bàn ăn gỗ tự nhiên thiết kế đẹp hiện đại là một lựa chọn không thể bỏ sót tại Bella Casa. Với phong cách thiết kế hiện đại, đường nét  tối giản, bộ bàn ăn gỗ tự nhiên mang đến người dùng một góc ăn uống vô cùng gọn gàng, đầm ấm.', 900000, 95, 1, '', 'ban3.jpg'),
(6, 'Giường ngủ lớn', 'Sẽ rất tiếc nuối nếu bạn bỏ lỡ mẫu giường ngủ gia đình phong cách hiện đại khi đến Go Home mua sắm đồ nội thất cho gia đình. Bên cạnh các sản phẩm như bàn trà, kệ tivi, tủ giày thì giường ngủ gia đình cũng là dòng sản phẩm được nhiều khách hàng chọn mua tại Bella Casa.', 3000000, 10, 5, '', 'giuong2.png'),
(7, 'Tủ quần áo gia đình', 'Tủ để quần áo gia đình phong cách hiện đại là một phần không thể thiếu được giúp bạn sắp xếp những bộ đồ của mình một cách gọn gàng và ngăn nắp nhất. Với phong cách thiết kế ấn tượng đẹp mắt, cùng một không gian lưu trữ rộng rãi, mẫu tủ để quần áo gia đình này của Bella Casa đa và đang chiếm được cảm tình của nhiều khách hàng.', 700000, 120, 2, '', 'tu1.jpg'),
(8, 'Tủ gỗ cao cấp', 'Một chiếc tủ quần áo như mẫu tủ quần áo gỗ sồi đẹp là một phần không thể thiếu trong không gian sống của mỗi gia đình. Mẫu tủ quần áo được làm từ chất liệu gỗ sồi nhập khẩu cao cấp, có thiết kế cửa lùa giúp người dùng tiết kiệm diện tích khi sử dụng.', 2550000, 10, 2, '', 'tu2.jpg'),
(9, 'Tủ quần áo công nghiệp', 'Mẫu tủ quần áo giá rẻ gỗ công nghiệp xứng đáng mà sản phẩm nổi bật nhất của dòng sản phẩm giá của nội thất Bella Casa. Mẫu tủ quần áo với thiết kế hiện đại, thanh lịch không thể nào thiếu vắng trong không gian sống của mỗi gia đình. Hiện nay, sản phẩm được bán tại mọi cửa hàng của Nội thất Go Home.', 900000, 30, 2, '', 'tu3.jpg'),
(10, 'Tủ đựng quần áo bằng gỗ', 'Tủ đựng quần áo bằng gỗ thiết kế đa năng tiện nghi kích thước lớn, đáp ứng nhu cầu sử dụng của rất nhiều gia đình. Thiết kế nhiều ngăn đa năng kết hợp với chất liệu gỗ bền đẹp giúp sử dụng trong từ 7 đến 10 năm. Cùng tìm hiểu chi tiết về kích thước và sự tiện nghi cũng như chất lượng của mẫu tủ đựng quần áo bằng gỗ đang được ưa chuộng này nhé!', 1900000, 22, 2, '', 'tu4.jpg'),
(11, 'Tủ quần áo gỗ MDF', 'Tủ quần áo gỗ MDF thiết kế sang trọng hiện đại GHS-5765 được rất nhiều gia đình lựa chọn. Với kích thước nhỏ gọn, đa năng, dễ bài trí trong không gian phòng ngủ. Chất liệu gỗ MDF đảm bảo độ bền, chống cong vênh và chịu lực, sử dụng được từ 7 đến 10 năm. Cùng tìm hiểu thêm về mẫu tủ quần áo gỗ MDF đang được ưa chuộng này nhé!', 1600000, 5, 2, '', 'tu5.jpg'),
(12, 'Tủ quần áo hiện đại', 'Tủ quần áo hiện đại cho gia đình được đánh giá cao về thiết kế, phù hợp với gout thẩm mỹ của rất nhiều khách hàng khi đến với Bella Casa. Tủ quần áo hiện đại nổi bật nhờ thiết kế tiện dụng, cung cấp cho người dùng không gian lưu trữ thoải mái. Bên cạnh đó, sản phẩm cũng có mức giá bán phải chăng, phù hợp với túi tiền của nhiều gia đình.', 2950000, 10, 2, '', 'tu6.png'),
(13, 'Bàn ăn gỗ gia đình', 'Bàn ăn gỗ gia đình thiết kế sang trọng hiện đại tạo điểm nhấn rất riêng cho không gian gia đình bạn. Sử dụng gỗ sồi tự nhiên tạo nên độ bền cho sản phẩm. Cùng chiêm ngưỡng thiết kế cận cảnh của mẫu bàn ăn gỗ gia đình 4 ghế đang được ưa chuộng này nhé!', 3100000, 15, 1, '', 'ban4.jpg'),
(14, 'Bàn ghế ăn đẹp', 'Không gian phòng ăn luôn được lấy cảm hướng từ sự yêu thương, đầm ấm nội thất trong đó như bàn ghế ăn đẹp, tủ bếp… được thiết kế theo xu hướng hiện đại, tiện dụng nhưng mang tới cảm giác ấm áp. Đến Nội thất Bella Casa để chọn lựa bộ bàn ăn phù hợp cho gia đình.', 4500000, 12, 1, '', 'ban5.jpg'),
(15, 'Bàn ăn gỗ công nghiệp', 'Chỉ với mức giá vô cùng hợp lý là bạn đã có thể sở hữu mẫu bàn ăn gỗ công nghiệp 4 ghế khung sắt hiện có tại Go Home Luxury. Kiểu dáng đơn giản, nhỏ gọn giúp mẫu bàn ăn vừa vặn với nhiều không gian phòng ăn gia đình. Bên cạnh đó, mẫu bàn ăn được cung cấp với 2 kích thước cho khách hàng nhiều lựa chọn hơn.', 4000000, 7, 1, '', 'ban6.jpg'),
(16, 'Giường gỗ công nghiệp', 'Giường ngủ GHS-940 làm bằng Gỗ MDF phun màu phủ bóng 2K với nhiều màu sắc lựa chọn. Sản phẩm Giường gỗ công nghiệp với họa tiết hình bông sen, phong cách Hiện đại, trẻ chung rất phù hợp cho phòng Bé gái. Nội thất Bella Casa có hàng nghìn mẫu với thiết kế kết hợp bởi nhiều xu hướng độc lạ trên toàn cầu.', 4500000, 20, 5, '', 'giuong4.jpg'),
(17, 'Giường ngủ gia đình', 'Giường ngủ gia đình gỗ sồi tự nhiên đẹp với thiết kế hiện đại, đa dạng về kích thước giúp bạn dễ dàng chọn lựa và bài trí trong không gian chung. Chất liệu gỗ sồi tự nhiên giúp bạn an tâm khi sử dụng, gỗ chịu lực tốt, chống cong vênh, mối mọt. Cùng tìm hiểu thêm về mẫu giường ngủ gia đình đang được ưa chuộng này nhé!', 8500000, 3, 5, '', 'giuong6.jpg'),
(18, 'Giường Gỗ tự nhiên', 'Giường ngủ gỗ tự nhiênlàm từ 100% gỗ tự nhiên với thiết kế mượt mà, lịch lãm luôn là điểm nhấn trong căn phòng ngủ của bạn. Với những tính năng tiện dụng, tính linh hoạt trong điều chỉnh kích thước và sử dụng sản phẩm, hãy liên hệ ngay với chúng tôi. Nội thất Bella Casa – đơn vị cung cấp giường ngủ uy tín. Hãy để chúng tôi tô điểm không gian sống nhà bạn.', 5000000, 10, 5, '', 'giuong5.jpg'),
(19, 'Kệ sách hiện đại', 'Mẫu tủ sách, tủ tài liệu đẹp, hiện đại là lựa chọn thích hợp cho những ai yêu thích những món đồ nội thất thanh lịch, hiện đại và hữu dụng. Tủ tài liệu được thiết kế với những ngăn tủ có cánh đảm bảo tạo ra không gian lưu trữ tốt nhất. Tùy theo nhu cầu sử dụng của bạn và gia đình có thể lựa chọn ra mẫu tủ với kích thước phù hợp', 4000000, 10, 4, '', 'ke1.jpg'),
(20, 'Tủ sách lớn, tủ văn phòng', 'Tủ sách lớn, tủ sách văn phòng  thiết kế trang nhã sang trọng phù hợp với nhiều không gian sử dụng. Tủ sách được làm từ gỗ công nghiệp đạt chuẩn, sản phẩm gồm 3 ngăn kéo, 4 khoang hộc tủ cánh kéo và các đợt được thiết kế dùng để sách hoặc vật dụng trang trí.', 3550000, 15, 4, '', 'ke2.jpg'),
(21, 'Kệ sách gia đình', 'Không chỉ là một mẫu tủ gia đình, tủ sách gia đình, tủ để tài liệu bằng gỗ công nghiệp cũng rất thích hợp cho các văn phòng, công ty. Tủ để tài liệu gây ấn tượng không chỉ nhờ vẻ đẹp thanh lịch mà còn là những tiện ích mà nó mang lại cho người dùng. Mẫu tủ có 3 kiểu dáng để bạn tùy ý lựa chọn theo nhu cầu sử dụng.', 1500000, 30, 4, '', 'ke3.jpg'),
(22, 'Tủ tài liệu bằng gỗ', 'Tủ tài liệu bằng gỗ tiện dụng được làm từ gỗ công nghiệp MDF cốt xanh cao cấp, bề mặt phủ Melamine chống thấm nước, chống trầy xước. Mẫu tủ tài liệu bằng gỗ này có kích thước khá đồ sộ, được chia làm nhiều khoang và ngăn tủ mang đến cho người dùng không gian lưu trữ lớn. Chắc chắn bạn sẽ không bao giờ phải hối tiếc khi đã lựa chọn chiếc tủ này cho không gian làm việc của mình.', 2500000, 25, 4, '', 'ke4.jpg'),
(23, 'Tủ sách gia đình', 'Tủ sách gia đình trưng bày phòng khách thực sự rất phù hợp với không gian sống của các gia đình Việt hiện nay. Không chỉ là một chiếc tủ sách gia đình đơn thuần, thiết kế ấn tượng còn biến sản phẩm thành một chiếc tủ trưng bày khiến bạn hãnh diện với mọi vị khách ghé chơi nhà. Có tận 3 kích thước khác nhau, chắc chắn bạn sẽ tìm thấy được mẫu sản phẩm cảm thấy ưng ý nhất tại Go Home.', 3300000, 7, 4, '', 'ke5.jpg'),
(24, 'Tủ đựng sách trưng bày', 'Tủ đựng sách trưng bày phòng khách thích hợp với những không gian sống theo phong cách thanh lịch, hiện đại. Nếu bạn đang có nhu cầu tìm mua một mẫu tủ đựng sách thì đây chính là một gợi ý đáng để cân nhắc. Sản phẩm phù hợp với nhiều không gian sử dụng khác nhau như phòng khách hay phòng làm việc tại nhà.', 3550000, 10, 4, '', 'ke6.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `mskh` int(11) NOT NULL,
  `hotenkh` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `tencongty` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `sodienthoai` varchar(12) COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`mskh`, `hotenkh`, `tencongty`, `sodienthoai`, `email`) VALUES
(1, 'Trần Văn H', 'ABC', '0966021941', 'g@gmail.com'),
(2, 'Nguyễn A', 'GHT', '0198765412', 'a@gmail.com'),
(55, 'Lê Bá Nhân ', 'Sao Mai', '071.123456', 'nhan@gmail.com'),
(56, 'Nguyễn Văn Thông', 'Hoàng Anh', '0198765412', 'thong@gmail.com'),
(57, 'Nguyễn Văn Tài', 'Ninh Kiều', '01987654548', 'tai@gmail.com'),
(58, 'Lâm Phước Như', 'Sao Mai', '0981240502', 'nhu@gmail.com'),
(59, 'Nguyễn Hoàng Thái', 'Viettel', '0481548524', 'thai@gmail.com'),
(60, 'Lê Bá Tính', 'Ánh Hồng', '071.123456', 'tinh@gmail.com'),
(61, 'Nguyễn Tài Trí', 'Ánh Dương', '01987851145', 'tri@gmail.com'),
(62, 'Nguyễn Văn Anh', 'Ninh Kiều', '0198708514', 'anh@gmail.com'),
(63, 'Trần Văn Thạch', 'Hừng Sáng', '0989240502', 'thach@gmail.com'),
(64, 'Đào Ánh Tuyết', 'Viettel', '0482863024', 'tuyet@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `maloaihang` int(11) NOT NULL,
  `tenloaihang` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`maloaihang`, `tenloaihang`) VALUES
(1, 'Bàn ăn'),
(2, 'Tủ quần áo'),
(4, 'Kệ sách'),
(5, 'Giường ngủ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `msnv` int(11) NOT NULL,
  `hotennv` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `chucvu` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `diachi` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `sodienthoai` varchar(12) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`msnv`, `hotennv`, `chucvu`, `diachi`, `sodienthoai`) VALUES
(1, 'Nguyễn Văn Thành', 'Nhân viên', '666 - Trần Văn Khéo - Tp. Cần Thơ', '0966021941'),
(2, 'Trần Thị Tiền', 'Admin', '444 - Trần Hưng Đạo - TP. Cà Mau', '0123056880'),
(3, 'Phạm Thành Tín', 'Kế toán', '35 Hung Vuong', '0964560257'),
(4, 'Lê Quốc Trọng', 'Quản trị ', 'Bạc Liêu', '0964905450');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`sodondh`,`mshh`),
  ADD KEY `mshh` (`mshh`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`sodondh`),
  ADD KEY `mskh` (`mskh`),
  ADD KEY `msnv` (`msnv`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`madc`),
  ADD KEY `mskh` (`mskh`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`mshh`),
  ADD KEY `hanghoa_ibfk_1` (`maloaihang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`mskh`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`maloaihang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`msnv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  MODIFY `sodondh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `sodondh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `madc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `mshh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `mskh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `maloaihang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `msnv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`sodondh`) REFERENCES `dathang` (`sodondh`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`mshh`) REFERENCES `hanghoa` (`mshh`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`msnv`) REFERENCES `nhanvien` (`msnv`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`mskh`) REFERENCES `khachhang` (`mskh`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`maloaihang`) REFERENCES `loaihanghoa` (`maloaihang`);

ALTER TABLE dathang ADD CONSTRAINT CONSTRAINT_10 CHECK (ngaydh <= ngaygh);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
