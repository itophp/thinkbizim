# 商品搜索

{% api-method method="get" host="https://api.cakes.com" path="/shop/goods/search?key=1" %}
{% api-method-summary %}
商品搜索
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="key" type="string" required=true %}
搜索关键词
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
        "search_key": "adidas",
        "sort": "",
        "sort_asc": "",
        "cate_ids": "2,77,87,24",
        "goods_nums": 154,
        "filter_menu": [],
        "filter_price": [],
        "filter_attr": [],
        "filter_brand": {
            "2": {
                "id": 2,
                "name": "小米（MI)",
                "logo": "/uploads/image/20171010/bb9c84408707bde3f74f02a04ad6c36a.jpg",
                "href": "/shop/goods/goodslist/id/1--2----.html"
            },
            ...
        },
        "filter_param": {
            "key": "1",
            "brand_id": "",
            "attr": "",
            "price": ""
        },
        "goodsList": {
            "total": 154,
            "per_page": 20,
            "current_page": 1,
            "data": [
                {
                    "id": 1008,
                    "name": "adidas 阿迪达斯 跑步 男子 跑步短袖T恤 喜水库红 DM2813",
                    "title": "adidas 阿迪达斯 跑步 男子 跑步短袖T恤 喜水库红 DM2813",
                    "goods_remark": "adidas is all in",
                    "goods_sn": "2018010911082415874",
                    "cat_id": "77",
                    "brand_id": "0",
                    "market_price": "199.00",
                    "shop_price": "199.00",
                    "cost_price": "0.00",
                    "thumb": "/picture/admin/454c39dd3bff2d14b98c70a89d8fa8aa.png",
                    "is_free_shipping": 1,
                    "sales_sum": 0,
                    "stock": 100,
                    "give_score": 0,
                    "need_score": 0,
                    "keywords": "",
                    "is_comm": 0,
                    "is_new": 0,
                    "is_hot": 0,
                    "max_buy": 0,
                    "mp_content": "&lt;image src=&quot;../../assets/upload/goods_d_1.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;\n&lt;image src=&quot;../../assets/upload/goods_d_2.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;\n&lt;image src=&quot;../../assets/upload/goods_d_3.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;\n&lt;image src=&quot;../../assets/upload/goods_d_4.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;\n&lt;image src=&quot;../../assets/upload/goods_d_5.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;\n&lt;image src=&quot;../../assets/upload/goods_d_6.png&quot; mode=&quot;aspectFill&quot;&gt;&lt;/image&gt;,/uploads/image/20180503/8b4380cafab61cfe7799072a5d1ad657.png,/uploads/image/20180503/8b4380cafab61cfe7799072a5d1ad657.png,/uploads/image/20180503/3d45917d936b8efcfdd538f207bb813e.png",
                },
                ...
            ]
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



