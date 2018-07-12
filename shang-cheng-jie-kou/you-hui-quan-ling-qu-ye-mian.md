# 优惠券领取页面

{% api-method method="get" host="https://api.cakes.com" path="/shop/coupon/index" %}
{% api-method-summary %}
获取优惠券列表
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="page" type="number" required=false %}
当前分页，默认为第一页
{% endapi-method-parameter %}

{% api-method-parameter name="sort" type="string" %}
排序方式，money:金额排序   time:时间排序
{% endapi-method-parameter %}

{% api-method-parameter name="cl" type="number" %}
优惠券等级，1、通用券     2、普通券
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
        "param": {
            "goods_id": "891"
        },
        "coupon_level": [
            {
                "id": 1,
                "name": "BIZ商务券",
                "en_name": "Business coupons",
                "explain": "该优惠券不限商品，不限分类，不限活动；可以进行无限制叠加，用于金额抵扣，且退货可返还。",
                "sketch": "",
                "description": "",
                "level": 1,
                "status": 1
            },
            {
                "id": 2,
                "name": "优惠券",
                "en_name": "Platform coupons",
                "explain": "",
                "sketch": "",
                "description": "",
                "level": 2,
                "status": 1
            }
        ],
        "list": [
            {
                "id": 55,
                "cid": 0,
                "shop_id": 0,
                "name": "测试优惠券",
                "icon": "/uploads/image/20180504/f4d735b5da94005aed2d944573c5acfc.png",
                "title": "测试优惠券",
                "sketch": "",
                "description": null,
                "coupon_level": 2,
                "discount_type": 5,
                "send_type": 4,
                "code_type": 1,
                "coupon_code": null,
                "user_group": "",
                "hierarchy": null,
                "goods": "0",
                "goods_category": "0",
                "promotion": 0,
                "money": "200.00",
                "quota": "20",
                "cn_quota": "20",
                "max_quota": 0,
                "send_money": "0.00",
                "send_user_level": "0",
                "num": 100,
                "one_use_num": 1,
                "use_days": 0,
                "send_num": 0,
                "used_num": 0,
                "use_start_time": 1525401368,
                "use_end_time": 1620095769,
                "send_start_time": 1525401372,
                "send_end_time": 1651631773,
                "add_time": 1525401376,
                "update_time": 0,
                "is_auto_send": "0",
                "status": 1,
                "index_show": 1,
                "coupon_level_name": "优惠券",
                "discount_type_id": "",
                "tisp": "全平台可用",
                "is_receive": false
            }
        ],
        "page": null
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



