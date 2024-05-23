Cơ sở dữ liệu thương mại điện tử cực kỳ tối giản (dùng cho việc quản lý hóa đơn)
-- Sử dụng với Mysql --

Các bảng:
- product: Lưu trữ thông tin sản phẩm
- inventory: Lưu trữ thông tin kho hàng, số lượng tồn kho của từng size số, từng sản phẩm
- customer: Lưu trữ thông tin khách hàng
- order: lưu trữ thông tin cơ bản của một đơn hàng
- order_item: lưu trữ thông tin, số lượng các sản phẩm có trong một đơn hàng theo từng size số
- payment: lưu trữ thông tin cơ bản của việc thanh toán cho một đơn hàng

Đi kèm theo là một số file sql mẫu:
- init: các file dùng để khởi tạo hoặc xóa bỏ database
- q: các query sql mẫu cho công việc DML
- insert_an_order: các câu lệnh insert cần dùng khi cần tạo một đơn hàng mới
- select_all_order: lấy thông tin về: id, tên khách hàng, số lượng sản phẩm, ngày mua, tổng giá trị,... của tất cả các đơn hàng
- select_top_5_product: chọn ra 5 sản phẩm có lượt bán nhiều nhất hoặc 5 sản phẩm còn tồn kho ít nhất (hoặc ngược lại)

Ngoài ra trong file init_create có đi kèm theo 3 trigger:
- kích hoạt khi DML một order_item: giúp tự động cập nhật lượt bán cho sản phẩm, số lượng tồn kho và tổng giá trị đơn hàng

Logic nghiệp vụ bên lề:
- Một đơn hàng có thể có rất nhiều trạng thái khác nhau. Ở trong CSDL này mình chỉ phân ra một số trạng thái dưới đây:
+ 1: chờ xác nhận - khách hàng đã đặt hàng, đặt đơn nhưng nhà bán hàng chưa check, chưa xác nhận đơn hàng
+ 2: Chờ lấy hàng - nhà bán hàng đã xác nhận đơn hàng và đang trong quá trình đóng gói hàng để giao cho bên vận chuyển.
+ 3: đang giao - đơn vị vận chuyển đã nhận gói hàng từ nhà bán và đang trên đường vận chuyển
+ 4: đã giao - đơn vị vận chuyển đã giao thành công gói hàng đến tay khách hàng
+ 5: đơn hủy - khách hàng đã đặt hàng nhưng thay đổi ý định không muốn mua nữa (nhà bán hàng chưa đóng gói đơn hàng bước 2)
+ 6: đang trả hàng - vì một lý do nào đó mà khách hàng muốn trả hàng, đã bàn giao gói hàng cho đơn vị vận chuyển
+ 7: đã trả hàng - đơn vị vận chuyển giao trả thành công gói hàng về cho nhà bán hàng
+ 8: thất lạc - đơn vị vận chuyển giao đi hoặc giao trả không thành công gói hàng và không tìm thấy gói hàng

- Các phương thức thanh toán trong bài này mình sử dụng:
+ 1: thanh toán bằng tiền mặt
+ 2: thanh toán chuyển khoản qua ngân hàng