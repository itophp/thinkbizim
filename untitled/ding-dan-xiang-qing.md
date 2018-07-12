# 订单详情

{% api-method method="get" host="https://api.cakes.com" path="/member/order/detail" %}
{% api-method-summary %}
获取订单详情，包括订单商品列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-path-parameters %}
{% api-method-parameter name="id" type="number" %}
订单ID
{% endapi-method-parameter %}
{% endapi-method-path-parameters %}
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
        "order_info": {
            "id": 13,
            "order_sn": "18041607595030598335",
            "pay_sn": null,
            "shipping_code": null,
            "shipping_sn": null,
            "user_id": 14,
            "order_prom_id": 0,
            "prom_type": 0,
            "coupon_id": 0,
            "biz_coupon": null,
            "order_prom_price": "0.00",
            "pay_code": "weixin",
            "total_price": "16.00",
            "payable_price": "16.00",
            "discount_price": "0.00",
            "balance_price": "0.00",
            "coupon_price": "0.00",
            "change_mny": "0.00",
            "pay_money": "0.00",
            "consignee": "吴跃忠",
            "phone": "13267057693",
            "zipcode": "518131",
            "province": 0,
            "city": 0,
            "district": 0,
            "address": "龙华新区新区大道新景大厦510",
            "points": 0,
            "points_price": "0.00",
            "postage": "0.00",
            "commission": "0.00",
            "add_time": "2018-04-16 19:59:50",
            "pay_time": null,
            "last_pay_time": "2018-04-18 19:59:50",
            "send_time": null,
            "receiving_time": null,
            "shipping_name": null,
            "invoice_title": null,
            "user_remark": null,
            "shop_remark": null,
            "pieces_id": 0,
            "is_send": 0,
            "is_pay": 0,
            "is_comment": 0,
            "is_commission": 0,
            "is_to_shop": 0,
            "id_key": null,
            "status": 1,
            "is_ping": 0,
            "status_str": null,
            "goods_list": [
                {
                    "id": 15,
                    "order_id": 13,
                    "goods_id": 613,
                    "goods_name": "倍思 捷速 快充数据线 5A(QC2.0-3.0) 华为Type-C口 1M",
                    "spec_id": 14403,
                    "spec_key": "379",
                    "spec_title": "컬러:블루,",
                    "points": 0,
                    "points_price": "0.00",
                    "shop_price": "16.00",
                    "pay_price": "16.00",
                    "total_price": "16.00",
                    "payable_price": "16.00",
                    "discount_price": "0.00",
                    "goods_num": 1,
                    "postage": "0.00",
                    "prom_type": 0,
                    "prom_id": 0,
                    "is_comment": 0
                }
            ]
        },
        "order_action": []
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
    "code": 41018,
    "data": {
        "message": "订单不存在"
    }
}
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}



