# 商品分类接口

{% api-method method="get" host="https://api.cakes.com" path="/shop/index/classify" %}
{% api-method-summary %}
获取商品分类接口
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="id" type="number" required=false %}
父级商品分类ID，返回子分类列表（默认为0）
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
    "data": {
        "first_category": [
            {
                "id": 1,
                "pid": 0,
                "name": "图书、音像、电子书刊",
                "en_name": null,
                "mobile_name": "图书",
                "parent_id_path": "0,1",
                "url_logo": "",
                "url": "/shop/goods/goodslist/id/1.html",
                "level": 1,
                "sort": 1000,
                "is_show": "1",
                "image": "",
                "is_index": "0",
                "is_hot": "1",
                "commission_rate": 0,
                "plat_rate": 0,
                "user_rate": 0,
                "index_template": "",
                "list_template": "",
                "detail_template": "",
                "attr_group": 1,
                "trash": "0",
                "advimg": "http://api.yjh.m.com"
            },
            ...
        ],
        "second_category": [
            {
                "id": 1,
                "pid": 0,
                "name": "图书、音像、电子书刊",
                "en_name": null,
                "mobile_name": "图书",
                "parent_id_path": "0,1",
                "url_logo": "",
                "url": "/shop/goods/goodslist/id/1.html",
                "level": 1,
                "sort": 1000,
                "is_show": "1",
                "image": "",
                "is_index": "0",
                "is_hot": "1",
                "commission_rate": 0,
                "plat_rate": 0,
                "user_rate": 0,
                "index_template": "",
                "list_template": "",
                "detail_template": "",
                "attr_group": 1,
                "trash": "0",
                "img": "http://api.yjh.m.com",
                "second_cid": 1
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



