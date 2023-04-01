<div class="main__content">
    <div class="grid wide">
        <div class="details">
            <div class="product__breadcrumb">
                <a href="">Trang chủ</a><i class="fa-solid fa-angle-right"></i>
                <a href="">Sửa bôt cao cấp</a><i class="fa-solid fa-angle-right"></i>
                <span>Sữa dê Bubs Goat số 3 800g (12-36 tháng)</span>
            </div>
            <div class="row details__group">
                <div class="col l-5 c-12 m-12 details__g-img">
                    <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="mySwiper" thumbs-swiper=".mySwiper2" space-between="10">
                        <swiper-slide>
                            <img class="details__img"
                                src="{{ asset('assets/imgs/'.$product->image) }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img class="details__img"
                                src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img class="details__img"
                                src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img class="details__img"
                                src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img class="details__img"
                                src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        </swiper-slide>
                    </swiper-container>

                    <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                        watch-slides-progress="true" navigation="true">
                        <swiper-slide>
                            <img src="{{ asset('assets/imgs/'.$product->image) }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                        <swiper-slide>
                            <img src="{{ asset('assets/imgs/thuc-pham-bo-sung-aptamil-2.jpg') }}" />
                        </swiper-slide>
                    </swiper-container>
                </div>
                <div class="col l-7 c-12 m-12">
                    <div class="details__name">{{$product->name}}</div>
                    <div class="details__group-evaluate">
                        <div class="star__evaluate">
                            <span>5.0</span>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="star__evaluate"><span>255</span>
                            <div class="star__evaluate-text">Đánh giá</div>
                        </div>
                        <div class="details__sold">
                            <div>255</div>
                            <div class="star__evaluate-text">Đã bán</div>
                        </div>
                    </div>
                    <div class="details__price">{{ $product->sale_price }}<span class="copper">đ</span></div>
                    <div class="details__quantity">
                        <div class="details__quantity-text">Số lượng</div>
                        <div class="details__quantity-add">
                            <button class="minus-btn" type="button">-</button>
                            <input type="number" min="1" max="{{ $product->quantity }}" value="1"
                                class="details__quantity-input">
                            <button class="plus-btn" type="button">+</button>
                        </div>
                        <div class="details__quantity-text">{{ $product->quantity }} sản phẩm có sẵn</div>
                    </div>
                    <div class="details__cart">
                        <button class="details__cart-add" wire:click.prevent="store({{$product->id}},'{{$product->name}}',{{$product->regular_price}})"><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ
                            hàng</button>
                        <button class="details__cart-buy">Mua ngay</button>
                    </div>
                </div>
            </div>
            <div class="row  details__information">
                <div class="col l-9 details__information-groups">
                    <div class="details__information-group">
                        <div class="details__information-title">
                            <div onclick="scrollToElement('target-element')" class="information__text text__active">Chi
                                tiết sản phẩm</div>
                            <div class="information__text">Đánh giá</div>
                            <div class="information__text">Thảo luận & hỏi đáp</div>
                        </div>
                    </div>
                    <table class=details__table>
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td>Thực phẩm bổ sung: Thức uống dinh dưỡng Enfagrow Premium Toddler Nutritional</td>
                        </tr>
                        <tr>
                            <td class="td__01">Thương hiệu</td>
                            <td>Mead Johnson</td>
                        </tr>
                        <tr>
                            <td class="td__01">Xuất xứ thương hiệu</td>
                            <td>Hoa kỳ</td>
                        </tr>
                        <tr>
                            <td class="td__01">Sản xuất tại</td>
                            <td>Hoa kỳ</td>
                        </tr>
                        <tr>
                            <td class="td__01">Trọng lượng sản phẩm</td>
                            <td>0.907</td>
                        </tr>
                        <tr>
                            <td class="td__01">Hướng dẫn sử dụng</td>
                            <td>Khuyến nghị: Uống 1 ly/1ngày, từ ly thứ 2, tham khảo ý kiến chuyên gia dinh dưỡng.
                                Sức khỏe của trẻ tùy thuộc vào sự tuân thủ chặt chẽ các hướng dẫn dưới đây:
                                Vệ sinh, chuẩn bị dụng cụ, pha chế, sử dụng và bảo quản một cách thích hợp rất quan
                                trọng trong quá trình pha chế cho trẻ, nên hỏi ý kiến bác sĩ để biết loại dụng cụ nào
                                phù hợp với con bạn
                                Rửa tay sạch với xà phòng và nước trước khi pha
                                Rửa sạch cốc hay dụng cụ và nắp.
                                Đun sôi các vật dụng trong 1 phút
                                Đun sôi nước trong 1 phút.
                                Để nước nguội đến 40 độ C (ấm) trước khi pha
                                Cho đúng lượng nước ấm vào cốc hay dụng cụ
                                Cho sản phẩm vào, đậy kỹ nắp dụng cụ và lắc đều
                                Để pha một ly Enfagrow cho trẻ, cho 3 muỗng gạt (36g bột) vào 6 ounces(tương đương
                                180ml) nước ấm (không quá 40 độ C).
                                Khuấy hay lắc đều, và cho trẻ sử dụng.</td>
                        </tr>
                        <tr>
                            <td class="td__01">Hướng dẫn bảo quản</td>
                            <td>Đậy kín nắp hộp sau khi mở và để ở nơi mát, khô ráo
                                . Không nên cho sản phẩm vào tủ lạnh
                                . Nên sử dụng trong vòng 4 tuần từ khi mở sản phẩm</td>
                        </tr>
                    </table>
                    <div class="details__describe">
                        Mô tả Sữa Hikid - Hàn Quốc vị vani (600g)
                        Sữa Hikid là dòng dinh dưỡng cao cấp của tập đoàn dinh dưỡng hàng đầu tại Hàn Quốc ILDONG FOODIS
                        giúp bé tăng trưởng vượt trội về chiều cao, cân nặng trong giai đoạn từ 1 - 9 tuổi. Sữa Hikid
                        chứa đầy đủ 5 dưỡng chất cần thiết cho tăng trưởng và phát triển đồng đều của bé, đặc biệt với
                        hàm lượng canxi cao sẽ giúp bé phát triển chiều cao tối ưu.

                        Sữa Hikid - Hàn Quốc (600g)

                        Sữa Hikid giúp bé tăng trưởng chiều cao tối ưu

                        Đặc điểm nổi bật của sữa Hikid (600g) Hàn Quốc
                        Thành phần sữa bột Hikid không chỉ cung cấp đầy đủ 5 dưỡng chất chính cần thiết cho tăng trưởng
                        và phát triển đồng đều của trẻ mà còn tăng cường hơn 60 dinh dưỡng tốt cho sự phá triển chiều
                        cao, tăng cường hệ miễn dịch, phát triển trí não và giúp hỗ trợ hệ tiêu hóa còn non nớt của bé..

                        Sữa Hikid giúp bé tăng trưởng cao lớn và khỏe mạnh hơn

                        Các chất vô cơ như canxi, sắt, kẽm và axit amino thiết yếu thường bị thiếu trong giai đoạn tăng
                        trưởng được bổ sung trong thành phần sữa Hikid giúp bé cao lớn

                        Tăng cường IGF và TGF, những nhân tố tăng trưởng quan trọng được tìm thấy trong sữa non.

                        Sữa Hikid giúp trẻ phát triển trí não, trí thông minh

                        Thành phần sữa Hikid có chứa DHA giúp trẻ phát triển trí não cũng như hỗ trợ các hoạt động năng
                        động của não.

                        Sphingomyelin và chất nhận biết của não trong sữa Hikid là những thành phần cấu tạo của não và
                        hệ thần kinh.

                        Tối đa hóa hiệu suất sử dụng thông qua việc tối ưu hóa tỷ lệ axit β-linoleic và axitα-linoleic.

                        Sữa Hikid giúp con tăng cường hệ miễn dịch

                        Thành phần miễn dịch - Immunoglobulin trong sữa Hikid sẽ ngăn chặn mầm bệnh và vi rút.

                        Các thành phần miễn dịch bao gồm axit β-linoleic và nucleotide, vv…

                        Dưỡng chất chống ôxi hóa và các vitamin hỗ trợ việc tăng cường khả năng đề kháng sinh lý cũng
                        được thêm vào trong sữa Hikid, đảm bảo bé có được sức đề kháng tốt nhất

                        Thông tin dinh dưỡng của sữa Hikid

                        Thông tin dinh dưỡng của sữa Hikid

                        Sữa Hikid giúp trẻ cải thiện hệ tiêu hóa

                        Thành phần hỗ trợ tiêu hóa và tăng cường chức năng ruột

                        GMP trong sữa Hikid sẽ ngăn chặn vi khuẩn có hại trong hệ tiêu hóa, giúp hệ tiêu hóa khỏe mạnh
                        hơn.

                        Thành phần tăng cường chức năng ruột như lactulose hỗ trợ sự đi tiêu dễ chịu hơn.

                        Với những ưu điểm trên, sữa Hikid Hàn Quốc là lựa chọn của nhiều gia đình khi có con nhỏ.

                        *** Lưu ý: Sữa Hikid là sữa công thức đặc thù dành riêng cho những bé muốn phát triển chiều cao
                        tối ưu. Chính vì vậy sữa Hikid được bổ sung vi chất nên khi mở hộp hoặc khi pha sữa, mẹ có thể
                        thấy những hạt màu xanh (có thể tan hoặc không tan). Điều này là hết sức bình thường & không ảnh
                        hưởng tới chất lượng sữa. Mẹ nên cho bé uống ngay sau khi pha.

                        Cách pha sữa Hikid nhập khẩu Hàn Quốc:
                        Cứ 180ml nước pha với 45g sữa Hikid tương đương 6-7 thìa gạt gang (1 thìa đong được 7g bột) lắc
                        đều cho tan.

                        Mẹ nên cho bé uống 2-3 lần/ngày.

                        Có thể điều chỉnh khối lượng sữa Hikid của mỗi bữa ăn theo mức độ tăng trưởng và phát triển của
                        trẻ.

                        Không được cho trẻ ăn tiếp phần sữa Hikid còn thừa lại của bữa trước vì có thể chất lượng sữa
                        không đảm bảo, bé có thể bị đau bụng.

                        Sữa Hikid sử dụng trong vòng 3 tuần sau khi mở hộp.

                        Đóng chặt nắp hộp để ngăn không cho hơi ẩm hoặc côn trùng thâm nhập sau khi mở hộp và bảo quản
                        sữa Hikid ở nơi mát mẻ, tránh ánh sáng mặt trời trực tiếp.

                        Thông tin sản phẩm sữa bột Hikid Hàn Quốc 600g Vani
                        Sữa Hikid hiện nay trên thị trường có nhiều hương vị khác nhau. Trong đó tại Shoptretho mẹ có 3
                        loại sữa Hikid để mẹ lựa chọn cho bé là: sữa Hikid hương Vani, sữa Hikid Premium, sữa Hikid
                        hương Socola.

                        Khối lượng: 600g

                        Dành cho bé từ 1 - 9 tuổi

                        Mẹ có thể đến trực tiếp các cửa hàng của chúng tôi xem sản phẩm và tham khảo thêm những sản phẩm
                        sữa cho trẻ sơ sinh khác tại đây hoặc cũng có thể đặt mua sữa Hikid online. Sản phẩm sẽ được
                        giao nhanh chóng đến tay quý khách nhanh nhất có thể.

                        Chúc ba mẹ chọn mua được sản phẩm sữa Hikid chính hãng, giá rẻ và ưng ý nhất cho bé!
                    </div>

                </div>
                <div class="col l-3 products-relate">
                    <div class="row product__list">
                        @foreach ($related_products as $r_product)
                            <div class="col l-12 c-12 m-12 product__item">
                                <div class="product__item-link">
                                    <a href="{{Route('product.details',['slug'=>$r_product->slug])}}">
                                        <img src="{{asset('assets/imgs/'.$r_product->image)}}" alt="{{$r_product->name}}"
                                            class="product__img">
                                        <div class="product__name">{{$r_product->name}}
                                        </div>
                                        <div class="product__group">
                                            <div class="product__price">{{$r_product->sale_price}} <span class="copper">đ</span></div>
                                            <div class="product__assess">5<i class="fa-solid fa-star"></i></i></div>
                                        </div>
                                    </a>
                                    <div class="product__with-cart">
                                        <a href="" class="product__buy-now btn-pink">Mua ngay</a>
                                        <a href="" class="product__cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
