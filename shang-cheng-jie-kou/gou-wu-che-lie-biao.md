# 购物车列表

{% api-method method="get" host="https://api.cakes.com" path="/shop/cart/cart" %}
{% api-method-summary %}
购物车列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}
Cake successfully retrieved.
{% endapi-method-response-example-description %}

```javascript
{
    "code": 200,
    "data": {
        "cartList": [
            {
                "id": 7,
                "user_id": 1,
                "session_id": "0",
                "goods": 947,
                "goods_name": "小米恒温电水壶",
                "market_price": "300.00",
                "shop_price": "239.00",
                "goods_num": 1,
                "bar_code": "2017110311382093641",
                "spec_id": null,
                "spec_key": "0",
                "spec_text": null,
                "prom_type": 1,
                "prom_id": 30,
                "selected": 1,
                "add_time": "2017-12-27 10:44:16",
                "status": 1
            }
        ],
        "total_price": 239,
        "cart_num": 1,
        "select_num": 1,
        "recomm_goods": [
            {
                "id": 779,
                "title": "AWEI苹果手机壳（6/6s) AWEI苹果手机壳（6/6s)",
                "goods_remark": "",
                "goods_sn": "1478511898",
                "cat_id": "2",
                "cat_tree": "0,2",
                "brand_id": "15",
                "market_price": "45.00",
                "shop_price": "18.00",
                "cost_price": "0.00",
                "thumb": "/uploads/goods/20171018/587.jpg",
                "sales_sum": 0,
                "stock": 100,
                "give_score": 0,
                "need_score": 0,
                "keywords": "아이폰케이스,케이스,데님케이스,패브릭케이스,아이폰6,아이폰6S,아이폰6PLUS,아이폰6S PLUS,아이폰 플러스",
                "is_comm": 1,
                "is_new": 0,
                "is_hot": 0,
                "max_buy": 3,
                "mp_content": null,
            },
            ...
        ]
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



