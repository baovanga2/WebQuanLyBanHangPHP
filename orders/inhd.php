<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>   </title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body > 
    <main>
        
      <h1  class="clearfix">  <img class="logo" src="logo_cty.png"/> HÓA ĐƠN BÁN HÀNG  </h1>
      <!-- /*onload="window.print()" */ -->
      <div>
        <?php 
          $date = getdate();  
            
        ?>
          <div class="notice"> Ngày in: <?php echo $date['mday']."/".$date['mon']."/".$date['year'];
     ?> </div>
          <div class="notice">Đơn vị bán hàng: <b>PC-HOUSE </b>  <small style="float: right; margin-right: 40px"><span>SỐ HĐ: </span> 089</small>
              <br/>
              Địa chỉ: <b>11 Phan Đình Phùng, Phường Tân An, Quận Ninh Kiều, Thành phố Cần Thơ</b> 
          </div>
        <div class="notice">Nhân viên bán hàng: <b>Lê Phúc Thuần</b>  
         </div>
          <br/>
           <hr/>
           <br/>
        <div class="notice">Tên khách hàng: <b>Bảo Vàng</b> </div>
        <div class="notice">SĐT: <b>0908767640</b> </div>
        <div class="notice">Địa chỉ: <b>Quận Ninh Kiều, Thành phố Cần Thơ</b> </div>
        <br/>
          <hr/>
          <br/>
      </div>
      <table>
        <thead>
         
        </thead>
        <tbody>
          <tr>
            <th class="service">STT</th>
            <th class="desc" >Mã sản phẩm</th>
            <th class="desc">Tên sản phẩm</th>
            <th class="qty">Số lượng</th>
            <th class="total">Giá</th>
            <th class="total">Tổng giá</th>
          </tr>
          <tr>
            <td class="service">1</td>
            <td class="desc" >RAM01</td>
            <td class="desc">Ram samsung 4GB</td>
            <td class="qty">2</td>
            <td class="total">400,000</td>
            <td class="total">800,000</td>
          </tr>
          <tr>
            <td class="service">2</td>
            <td class="desc" >RAM01</td>
            <td class="desc">Ram samsung 8GB</td>
            <td class="qty">1</td>
            <td class="total">800,000</td>
            <td class="total">800,000</td>
          </tr>
          <tr>
            <td class="service">3</td>
            <td class="desc">RAM01</td>
            <td class="desc">SSD samsung 250GB</td>
            <td class="qty">1</td>
            <td class="total">1,000,000</td>
            <td class="total">1,000,000</td>
          </tr>
          
          <tr>
            <td colspan="5" class="sub">Tiền khách đưa:</td>
            <td class="sub total">3,000,000</td>
          </tr>
          <tr>
            <td colspan="5">Tổng tiền hàng:</td>
            <td class="total">2,600,000</td>
          </tr>
          <tr>
            <td colspan="5" class="total">Tiền thừa của khách</td>
            <td class="total">400,000</td>
          </tr>
        </tbody>
      </table>
      <div id="details" class="clearfix">
          <div id="project">
            <div class="arrow">Khách hàng</div>
            <br/>
            <br/>
            <br/>
            <div class="arrow"><b>Bảo Vàng</b></div>
          </div>
          <div id="company">
            <div class="arrow back">Nhân viên bán hàng </div>
            <br/>
            <br/>
            <br/>
            <div class="arrow back"> <b>Lê Phúc Thuần</b>  </div>
        </div>
      
      </div>
      <div id="notices">
        
          <div class="notice">Cảm ơn và hẹn gặp lại quý khách!</div>
    </main>

  </body>
</html>