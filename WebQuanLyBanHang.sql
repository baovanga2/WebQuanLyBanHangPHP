drop database if exists WebQuanLyBanHang;
create database WebQuanLyBanHang;
use WebQuanLyBanHang;

drop table if exists CATEGORIES;

drop table if exists CUSTOMERS;

drop table if exists ORDERDETAILS;

drop table if exists ORDERS;

drop table if exists PRODUCERS;

drop table if exists PRODUCTS;

drop table if exists ROLES;

drop table if exists USERS;

/*==============================================================*/
/* Table: CATEGORIES                                 */
/*==============================================================*/
create table CATEGORIES
(
   CA_ID                int not null AUTO_INCREMENT,
   CA_NAME              varchar(50) not null,
   CA_DESCRIPTION       text,
   primary key (CA_ID)
);

/*==============================================================*/
/* Table: CUSTOMERS                                   */
/*==============================================================*/
create table CUSTOMERS
(
   CUS_ID               int not null AUTO_INCREMENT,
   CUS_FULLNAME         varchar(50) not null,
   CUS_EMAIL            varchar(50),
   CUS_ADDRESS          text,
   CUS_GENDER           varchar(10) not null,
   CUS_PHONE            varchar(11) not null,
   CUS_BIRTHDAY         date,
   primary key (CUS_ID)
);

/*==============================================================*/
/* Table: ORDERDETAILS                           */
/*==============================================================*/
create table ORDERDETAILS
(
   PRO_ID               int not null,
   OR_ID                int not null,
   OD_QUANTITY          int not null,
   OD_PRICE             decimal not null
);

/*==============================================================*/
/* Table: ORDERS                                     */
/*==============================================================*/
create table ORDERS
(
   OR_ID                int not null AUTO_INCREMENT,
   CUS_ID               int not null,
   U_ID                 int not null,
   OR_CREATEDDATE       timestamp not null,
   OR_TotalPrice		decimal not null,
   primary key (OR_ID)
);

/*==============================================================*/
/* Table: PRODUCERS                                  */
/*==============================================================*/
create table PRODUCERS
(
   PR_ID                int not null AUTO_INCREMENT,
   PR_NAME              varchar(50) not null,
   PR_DESCRIPTION       text,
   primary key (PR_ID)
);

/*==============================================================*/
/* Table: PRODUCTS                                      */
/*==============================================================*/
create table PRODUCTS
(
   PRO_ID               int not null AUTO_INCREMENT,
   PR_ID                int not null,
   CA_ID                int not null,
   PRO_NAME             varchar(100) not null,
   PRO_DETAIL           text,
   PRO_PRICE            decimal not null,
   PRO_QUANTITY         int not null,
   primary key (PRO_ID)
);


/*==============================================================*/
/* Table: ROLES                                                 */
/*==============================================================*/
create table ROLES
(
   R_ID                 int not null AUTO_INCREMENT,
   R_NAME               varchar(50) not null,
   primary key (R_ID)
);

/*==============================================================*/
/* Table: USERS                                       */
/*==============================================================*/
create table USERS
(
   U_ID                 int not null AUTO_INCREMENT,
   R_ID                 int not null,
   U_FULLNAME           varchar(50) not null,
   U_EMAIL              varchar(50) not null,
   U_ADDRESS            text not null,
   U_HOMETOWN           text not null,
   U_PHONE              varchar(11) not null,
   U_GENDER             varchar(10) not null,
   U_LOGINNAME          varchar(20) not null,
   U_PASSWORD           text not null,
   U_BIRTHDAY			date not null,
   primary key (U_ID)
);

create table password_change_history
(
	id	int not null auto_increment,
	user_is_changed varchar(20) not null,
	user_changed varchar(20) not null,
	change_at varchar(255) not null,
	primary key (id)
);

alter table ORDERDETAILS add constraint FK_OD_PRO foreign key (PRO_ID)
      references PRODUCTS (PRO_ID) on delete restrict on update CASCADE;

alter table ORDERDETAILS add constraint FK_OD_OR foreign key (OR_ID)
      references ORDERS (OR_ID) on delete cascade on update CASCADE;

alter table ORDERS add constraint FK_OR_CUS foreign key (CUS_ID)
      references CUSTOMERS (CUS_ID) on delete restrict on update CASCADE;

alter table ORDERS add constraint FK_OR_U foreign key (U_ID)
      references USERS (U_ID) on delete restrict on update CASCADE;

alter table PRODUCTS add constraint FK_PRO_PR foreign key (PR_ID)
      references PRODUCERS (PR_ID) on delete restrict on update CASCADE;

alter table PRODUCTS add constraint FK_PRO_CA foreign key (CA_ID)
      references CATEGORIES (CA_ID) on delete restrict on update CASCADE;

alter table USERS add constraint FK_U_R foreign key (R_ID)
      references ROLES (R_ID) on delete restrict on update CASCADE;
          
/*================= INSERT INTO DATA=====================*/
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('CPU - Bộ vi xử lý','CPU là chữ viết tắt của Central Processing Unit hay còn gọi là bộ xử lý trung tâm. CPU đóng vai trò như não bộ của một chiếc máy tính, tại đó mọi thông tin, thao tác, dữ liệu sẽ được tính toán kỹ lưỡng và đưa ra lệnh điều khiển mọi hoạt động của Laptop');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Mainboard - Bo mạch chủ','Bo mạch chủ là một bảng mạch in (Printed Circuit Board – PCB) dùng để kết nối các thành phần khác của chiếc máy tính như CPU, GPU, RAM, card mạng,... lại với nhau để máy tính hoạt động được');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('RAM','RAM là một loại bộ nhớ khả biến cho phép truy xuất đọc-ghi ngẫu nhiên đến bất kỳ vị trí nào trong bộ nhớ dựa theo địa chỉ ô nhớ. Thông tin lưu trên RAM chỉ là tạm thời, chúng sẽ mất đi khi mất nguồn điện cung cấp');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('VGA - Card màn hình','VGA có nhiệm vụ xử lý hình ảnh cũng như màu sắc trong máy tính. Ngoài ra nó còn xử lý độ phân giải độ tương phản, chất lượng hình ảnh hiển thị trên màn hình, … thông qua kết nối với màn hình để hiện thị hình ảnh giúp người dùng thực hiện thao tác trên máy tính hay laptop');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('PSU - Nguồn','Nguồn máy tính là một thiết bị cung cấp năng lượng cho bo mạch chủ, ổ cứng, ổ quang và các thiết bị khác..., đáp ứng năng lượng cho tất cả các thiết bị phần cứng của máy tính hoạt động');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Case máy tính','Case máy tính là một bộ phận bên ngoài có tác dụng bao bọc cho các thành phần bên trong của máy tính, tránh được các tác động không mong muốn từ bên ngoài');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Ổ cứng','Ổ cứng là một thành phần quan trọng trong máy tính, tất cả dữ liệu của người dùng như hệ điều hành windows hoặc dữ liệu cá nhân đều được lưu trữ trong ổ cứng và chúng luôn được truy xuất thường xuyên');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Màn hình máy tính','Màn hình máy tính là thiết bị điện tử gắn liền với máy tính với mục đích chính là hiển thị và giao tiếp giữa người sử dụng với máy tính');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Chuột máy tính','Chuột máy tính là một thiết bị ngoại vi của máy tính dùng để điều khiển và làm việc với máy tính');
insert into CATEGORIES(CA_NAME,CA_DESCRIPTION) values('Bàn phím máy tính','Bàn phím là thiết bị chính giúp người sử dụng giao tiếp và điều khiển hệ thống máy tính');
insert into CATEGORIES (CA_NAME) values ('Tản nhiệt');

insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Quân Mặc Tà','ttp@gmail.com','Hà Nội','Nam','0912345670','1990-1-1');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Lục Thiếu Du','ltd@gmail.com','Kiên Giang','Nam','0982636124','1996-11-6');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Lục Vô Song','lvs@gmail.com','Tiền Giang','Nữ','0215541400','1996-3-4');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('La Ngọc Nhi','lnn@gmail.com','Cà Mau','Nữ','0549875642','1995-5-5');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Lăng Tiếu','lt@gmail.com','Đồng Tháp','Nam','0315489652','1993-8-25');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Mai Tố Dao','mtd@gmail.com','Quảng Ninh','Nữ','0931459834','1992-6-25');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Thẩm Vạn Tam','tvt@gmail.com','Mỹ Tho','Nam','0123984821','1993-12-15');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Tịch Thiên Dạ','ttd@gmail.com','Bắc Giang','Nam','0169831675','1995-11-24');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Chúc Diễm Tam','cdt@gmail.com','Ninh Bình','Nữ','0981547568','1991-5-19');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Lý Thất Dạ','ltd@gmail','Sóc Trăng','Nam','0364851674','1991-5-15');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Mai Ngạo Nam','mnn@gmail.com','Bình Thuận','Nữ','0756981543','1995-5-5');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Mai Ngạo Tuyết','mnt@gmail.com','An Giang','Nam','0354815698','1994-4-5');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Đường Tam','dt@gmail.com','Hậu Giang','Nam','0123685462','1993-12-25');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Cổ Huân Nhi','chn@gmail.com','Vĩnh Long','Nữ','0394568561','1991-11-23');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Diệp An Thế','dat@gmail.com','Cà Mau','Nam','0156845621','1998-12-28');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Tiêu Sở Hà','tsh@gmail.com','Khánh Hòa','Nam','0236582461','1995-6-12');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Lôi Vô Kiệt','lvk@gmail.com','Cần Thơ','Nam','0158759565','1991-4-25');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Diễm Linh Cơ','dlc@gmail.com','Bắc Giang','Nữ','0125489652','1992-5-26');
insert into CUSTOMERS(CUS_FULLNAME,CUS_EMAIL,CUS_ADDRESS,CUS_GENDER,CUS_PHONE,CUS_BIRTHDAY) values('Tiểu Y Tiên','tyt@gmail.com','Lào Cai','Nữ','0135485265','1990-8-15');

insert into ROLES(R_NAME) values('Quản trị viên');
insert into ROLES(R_NAME) values('Nhân viên');

insert into USERS(R_ID, U_FULLNAME,U_EMAIL,U_ADDRESS,U_HOMETOWN,U_PHONE,U_GENDER,U_LOGINNAME,U_PASSWORD, U_BIRTHDAY) values(1, 'Lê Văn Bảo Vàng','lvbv@gmail.com','Cần Thơ','Đồng Tháp','0123456789','Nam','vang','e2dc344e217c6d8df06092b032099fb3', '1997-3-19');
insert into USERS(R_ID, U_FULLNAME,U_EMAIL,U_ADDRESS,U_HOMETOWN,U_PHONE,U_GENDER,U_LOGINNAME,U_PASSWORD, U_BIRTHDAY) values(2, 'Đoàn Thị Huyền Trân','dtht@gmail.com','Cần Thơ','Xứ lạ','0123456780','Nữ','tran','c4ca4238a0b923820dcc509a6f75849b', '1997-12-30');
insert into USERS(R_ID, U_FULLNAME,U_EMAIL,U_ADDRESS,U_HOMETOWN,U_PHONE,U_GENDER,U_LOGINNAME,U_PASSWORD, U_BIRTHDAY) values(2, 'Phạm Quốc Toàn','pqt@gmail.com','Cần Thơ','Xứ lạ','0123456781','Nam','toan','c4ca4238a0b923820dcc509a6f75849b', '1997-12-30');
insert into USERS(R_ID, U_FULLNAME,U_EMAIL,U_ADDRESS,U_HOMETOWN,U_PHONE,U_GENDER,U_LOGINNAME,U_PASSWORD, U_BIRTHDAY) values(2, 'Danh Hậu','dh@gmail.com','Cần Thơ','Xứ lạ','0123456782','Nam','hau','c4ca4238a0b923820dcc509a6f75849b', '1997-12-30');
insert into USERS(R_ID, U_FULLNAME,U_EMAIL,U_ADDRESS,U_HOMETOWN,U_PHONE,U_GENDER,U_LOGINNAME,U_PASSWORD, U_BIRTHDAY) values(1, 'Phạm Hoàng Viện','lvbv@gmail.com','Cần Thơ','Xứ lạ','0123456789','Nam','vien','c4ca4238a0b923820dcc509a6f75849b', '1997-12-30');

insert into PRODUCERS(PR_NAME) values('Logitech');
insert into PRODUCERS(PR_NAME) values('ASUS');
insert into PRODUCERS(PR_NAME) values('Gigabyte');
insert into PRODUCERS(PR_NAME) values('MSI');
insert into PRODUCERS(PR_NAME) values('Intel');
insert into PRODUCERS(PR_NAME) values('Corsair');
insert into PRODUCERS(PR_NAME) values('Razer');
insert into PRODUCERS(PR_NAME) values('SteelSeries');
insert into PRODUCERS(PR_NAME) values('Fuhlen');
insert into PRODUCERS(PR_NAME) values('G.SKill');
insert into PRODUCERS(PR_NAME) values('Kingston');
insert into PRODUCERS(PR_NAME) values('Dell');
insert into PRODUCERS(PR_NAME) values('Samsung');
insert into PRODUCERS(PR_NAME) values('HP');
insert into PRODUCERS(PR_NAME) values('LG');
insert into PRODUCERS(PR_NAME) values('AMD');
insert into PRODUCERS(PR_NAME) values('Cooler Master');
insert into PRODUCERS(PR_NAME) values('Acer');
insert into PRODUCERS(PR_NAME) values('BenQ');
insert into PRODUCERS(PR_NAME) values('Lenovo');
insert into PRODUCERS(PR_NAME) values('DareU');

insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(5,1,'CPU Intel Core i9-9900K',13500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(16,1,'CPU AMD Ryzen Threadripper 1920X',22200000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(4,2,'Mainboard MSI MEG X399 CREATION',12600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(3,2,'Mainboard GIGABYTE Z390 DESIGNARE',7400000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(2,2,'Mainboard ASUS ROG Strix Z390-F Gaming',5600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(10,3,'RAM G.SKILL TridentZ RGB 2x16GB DDR4 3000MHz',5500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(11,3,'RAM laptop Kingston (1x16GB) DDR4 2400MHz',2600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(6,3,'RAM desktop CORSAIR Vengeance (2x8GB) DDR4 2400MHz',3700000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(2,4,'Card màn hình ASUS GeForce RTX 2080Ti 11GB GDDR6 DUAL OC',36600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(3,4,'Card màn hình GIGABYTE GeForce RTX 2080Ti 11GB GDDR6 AORUS Xtreme',38700000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(4,4,'Card màn hình MSI GeForce RTX 2080Ti 11GB GDDR6 VENTUS',36000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(6,5,'Nguồn máy tính CORSAIR CX750M - 750W - 80 Plus Bronze - Semi Modular',2400000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(17,5,'Nguồn máy tính Cooler Master MWE Gold 750 - 750W - 80 Plus Gold - Full Modular',2600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(17,6,'Case máy tính Cooler Master Cosmos C700P',7700000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(17,11,'Tản nước AIO Cooler Master MASTERLIQUID ML240R RGB',2700000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(6,11,'Quạt CORSAIR LL120 RGB 120mm (3fan + Lighting node Pro)',2800000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(5,7,'Ổ cứng SSD Intel Optane 32GB M.2 NVMe',990000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(13,7,'Ổ cứng SSD Samsung 970 Pro 512GB M.2 2280 NVMe',6300000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(11,7,'Ổ cứng SSD Kingston 480GB 2.5" SATA 3',3900000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(5,7,'Ổ cứng SSD Intel 540s 360GB 2.5" SATA 3',2700000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(3,7,'Ổ cứng SSD GIGABYTE AORUS RGB M.2 NVMe SSD 256GB 256GB M.2 2280 NVMe',2000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(18,8,'Màn Hình Acer 27" XB271H (1920x1080/TN/144Hz/1ms/G-Sync)',13200000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(2,8,'Màn Hình ASUS ROG Swift 27" PG279Q (2560x1440/IPS/165Hz/4ms/G-Sync)',20000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(19,8,'Màn Hình BenQ Zowie 24.5" XL2546 (1920x1080/TN/240Hz/1ms)',12500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(12,8,'Màn Hình Dell Ultrasharp 27" U2718Q (3840x2160/IPS/60Hz/5ms)',13900000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(14,8,'Màn Hình HP 24" Z24n G2 (1JS09A4) (1920x1200/IPS/60Hz/5ms)',8800000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(20,8,'Màn Hình Lenovo 27" L27i-28 (1920x1080/IPS/75Hz/4ms/FreeSync)',4500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(15,8,'Màn Hình LG 27" 27MD5KA-B (5120x2880/IPS/60Hz/12ms)',27500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(4,8,'Màn Hình MSI Optix 32" AG32C (1920x1080/VA/165Hz/1ms/FreeSync)',8200000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(13,8,'Màn Hình cong Samsung 34" LC34J791WTEXXV (3440x1440/VA/100Hz/4ms/FreeSync)',29000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(1,9,'Chuột không dây Logitech G903',3800000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(6,9,'Chuột máy tính Corsair Glaive RGB Aluminum',2000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(7,9,'Chuột không dây Razer Mamba Wireless',2600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(8,9,'Chuột không dây SteelSeries Rival 650 Wireless',2800000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(9,9,'Chuột Fuhlen G90 Pro 5000 DPI Infrared USB Led RGB',600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(1,10,'Bàn phím cơ Logitech Gaming G512 (Full size /Romer-G Tactile)',3000000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(6,10,'Bàn phím cơ CORSAIR K95 Platinum (Full size/Cherry MX Speed Brown/RGB)',4600000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(7,10,'Bàn phím cơ Razer BlackWidow Elite (Full size/Razer Green/RGB)',4500000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(9,10,'Bàn phím cơ Fuhlen Destroyer (Full size/Optical Switch/7 màu)',900000,50);
insert into PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_PRICE,PRO_QUANTITY) values(21,10,'Bàn phím cơ Dareu DK1280 RGB (Full size/Brown D switch/RGB)',1000000,50);

insert into orders(or_id, cus_id, u_id, or_totalprice, or_createddate) values (1, 1, 1, 35500000, '2019-1-3');
insert into orders(or_id, cus_id, u_id, or_totalprice, or_createddate) values (2, 2, 1, 34600000, '2019-1-3');
insert into orders(or_id, cus_id, u_id, or_totalprice, or_createddate) values (3, 2, 1, 34600000, '2019-2-3');
insert into orders(or_id, cus_id, u_id, or_totalprice, or_createddate) values (4, 3, 1, 34600000, '2019-2-3');

insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(1,1,1,13500000);
insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(2,1,1,22200000);
insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(2,2,1,22200000);
insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(3,2,1,12600000);
insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(3,3,1,12600000);
insert into ORDERDETAILS(PRO_ID,OR_ID,OD_QUANTITY,OD_PRICE) values(4,3,1,12600000);





