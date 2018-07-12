# 订单列表页

{% api-method method="get" host="https://api.cakes.com" path="/member/order/index" %}
{% api-method-summary %}
获取订单列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="page" type="number" required=false %}
当前分页
{% endapi-method-parameter %}
{% endapi-method-query-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 200,
    "data": {
        "status": "all",
        "days": "",
        "month": "",
        "time_start": "",
        "time_end": "",
        "page": null,
        "orderList": {
            "13": {
                "id": 13,
                "order_sn": "18041607595030598335",
                "payable_price": "16.00",
                "pieces_id": 0,
                "add_time": "2018-04-16 19:59:50",
                "goods_list": [
                    {
                        "id": 15,
                        "goods_id": 613,
                        "goods_num": 1,
                        "spec_key": "379",
                        "goods_name": "倍思 捷速 快充数据线 5A(QC2.0-3.0) 华为Type-C口 1M",
                        "thumb": "/uploads/goods/20171018/421.jpg"
                    }
                ]
            },
            "14": {
                "id": 14,
                "order_sn": "18042411310637482760",
                "payable_price": "11.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 11:31:06",
                "goods_list": [
                    {
                        "id": 16,
                        "goods_id": 614,
                        "goods_num": 1,
                        "spec_key": "377",
                        "goods_name": "倍思 简捷便携款 USB-A输出 苹果 Lightning数据线",
                        "thumb": "/uploads/goods/20171018/422.jpg"
                    }
                ]
            },
            "15": {
                "id": 15,
                "order_sn": "18042412041232918589",
                "payable_price": "110.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 12:04:12",
                "goods_list": [
                    {
                        "id": 17,
                        "goods_id": 881,
                        "goods_num": 1,
                        "spec_key": "1997",
                        "goods_name": "星晨",
                        "thumb": "/uploads/goods/20171027/bcbb6b9d52127d42240545bd56e9f272.png"
                    }
                ]
            },
            "16": {
                "id": 16,
                "order_sn": "18042412044252112813",
                "payable_price": "807.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 12:04:42",
                "goods_list": [
                    {
                        "id": 18,
                        "goods_id": 633,
                        "goods_num": 1,
                        "spec_key": "357",
                        "goods_name": "AMAZFIT 华米运动手表",
                        "thumb": "/uploads/goods/20171018/441.jpg"
                    }
                ]
            },
            "17": {
                "id": 17,
                "order_sn": "18042412053064651601",
                "payable_price": "88.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 12:05:30",
                "goods_list": [
                    {
                        "id": 19,
                        "goods_id": 892,
                        "goods_num": 1,
                        "spec_key": "1056",
                        "goods_name": "48ZH-2",
                        "thumb": "/uploads/goods/20171027/ece0397a260049cff407f97843655af9.png"
                    }
                ]
            },
            "18": {
                "id": 18,
                "order_sn": "18042412063932953329",
                "payable_price": "88.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 12:06:39",
                "goods_list": [
                    {
                        "id": 20,
                        "goods_id": 892,
                        "goods_num": 1,
                        "spec_key": "1056",
                        "goods_name": "48ZH-2",
                        "thumb": "/uploads/goods/20171027/ece0397a260049cff407f97843655af9.png"
                    }
                ]
            },
            "19": {
                "id": 19,
                "order_sn": "18042412072613426516",
                "payable_price": "88.00",
                "pieces_id": 0,
                "add_time": "2018-04-24 12:07:26",
                "goods_list": [
                    {
                        "id": 21,
                        "goods_id": 892,
                        "goods_num": 1,
                        "spec_key": "1056",
                        "goods_name": "48ZH-2",
                        "thumb": "/uploads/goods/20171027/ece0397a260049cff407f97843655af9.png"
                    }
                ]
            }
        }
    }
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}
Could not find a cake matching this query.
{% endapi-method-response-example-description %}

```javascript
{
    "message": "Ain't no cake like that."
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



