# 优惠码搜索

{% api-method method="get" host="https://api.cakes.com" path="/shop/coupon/code\_coupon" %}
{% api-method-summary %}
通过优惠码搜索优惠券
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="code" type="string" required=true %}
用户拥有的优惠码，需要注意大小写，PS：1lWsbxk3GT4k
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
        "vo": {
            "id": 56,
            "cid": 0,
            "icon": "",
            "title": "优惠码优惠券",
            "sketch": "",
            "description": null,
            "coupon_level": 2,
            "discount_type": 5,
            "send_type": 9,
            "code_type": 1,
            "coupon_code": null,
            "user_group": "",
            "hierarchy": null,
            "goods": "0",
            "goods_category": "0",
            "promotion": 0,
            "money": "1000.00",
            "quota": "80",
            "cn_quota": "80",
            "max_quota": 0,
            "send_money": "0.00",
            "one_use_num": 1,
            "use_days": 30,
            "use_start_time": 1525402562,
            "use_end_time": 1651632964,
            "send_start_time": 1525402571,
            "send_end_time": 1620096972,
            "status": 1,
            "index_show": 1,
            "code": "1lWsbxk3GT4k",
            "message": "立即领取",
            "coupon_level_name": "优惠券",
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



