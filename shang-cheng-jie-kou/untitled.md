# 商品详情页

{% api-method method="get" host="https://api.cakes.com" path="/goods/:id" %}
{% api-method-summary %}
获取商品详情内容
{% endapi-method-summary %}

{% api-method-description %}
This endpoint allows you to get free cakes.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-path-parameters %}
{% api-method-parameter name="id" type="number" required=true %}
商品ID，直接把ID加到连接后面，例如：  
http://api.hn.juntest.com/goods/891
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
    "code": 1,
    "data": {
        "second_spec": false,
        "pannel": "",
        "goods": {
            "id": 891,
            "lang": 1,
            "name": null,
            "title": "48ZH-1",
            "model": 0,
            "create_time": "2017-10-27 18:14:06",
            "update_time": "2017-11-06 13:41:32",
            "sort": 100,
            "status": 1,
            "view": 0,
            "trash": 0,
            "goods_remark": "",
            "goods_sn": "2017102718140672791",
            "cat_id": "2",
            "cat_tree": "0,2",
            "brand_id": "0",
            "market_price": "0.00",
            "shop_price": "88.00",
            "cost_price": "58.00",
            "thumb": "/uploads/goods/20171027/74bdd2d0c892ce445958027e38af58ba.png",
            "weight": 100,
            "is_free_shipping": 0,
            "sales_sum": 0,
            "stock": 100,
            "give_score": 0,
            "need_score": 0,
            "keywords": "키링 열쇠고리 가방 악세서리 키홀더 자동차 키링",
            "is_comm": 0,
            "is_new": 0,
            "is_audit": 1,
            "is_hot": 0,
            "max_buy": 0,
            "mp_content": [
                {
                    "img": "http://api.yjh.m.com"
                }
            ],
            "bzqd": null,
            "comment_count": 0,
            "brand_name": null
        },
        "goods_specs": [
            "1056",
            "1057",
            "1058",
            "1059"
        ],
        "lowPriceKey": [
            "1056"
        ],
        "filter_spec": {
            "173": {
                "id": 173,
                "pid": 0,
                "cate_id": 160,
                "cate_tree": null,
                "icon": null,
                "name": "序号",
                "sort": 100,
                "search_index": 0,
                "status": 1,
                "item": [
                    {
                        "id": 1056,
                        "pid": 0,
                        "spec_id": 173,
                        "item": "1",
                        "icon": null,
                        "sort": 100,
                        "status": 1,
                        "spec_key": "1056",
                        "href": "/goods/891/s/1056.html"
                    },
                    {
                        "id": 1057,
                        "pid": 0,
                        "spec_id": 173,
                        "item": "2",
                        "icon": null,
                        "sort": 100,
                        "status": 1,
                        "spec_key": "1057",
                        "href": "/goods/891/s/1057.html"
                    },
                    {
                        "id": 1058,
                        "pid": 0,
                        "spec_id": 173,
                        "item": "3",
                        "icon": null,
                        "sort": 100,
                        "status": 1,
                        "spec_key": "1058",
                        "href": "/goods/891/s/1058.html"
                    },
                    {
                        "id": 1059,
                        "pid": 0,
                        "spec_id": 173,
                        "item": "4",
                        "icon": null,
                        "sort": 100,
                        "status": 1,
                        "spec_key": "1059",
                        "href": "/goods/891/s/1059.html"
                    }
                ]
            }
        },
        "spec_str": "옵션:01,",
        "attr_list": {
            "4138": "DREAMER XIN",
            "4139": "",
            "4140": "CHINA",
            "4143": ""
        },
        "goods_content": "&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;/uploads/goods/20171027/a26f5db4b143c77f8d98976c7f27d09d.jpg&quot; title=&quot;20171027/a26f5db4b143c77f8d98976c7f27d09d.jpg&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;img src=&quot;/uploads/goods/20171027/c4b537e7331890a74b5c8c3a8b119313.jpg&quot; title=&quot;20171027/c4b537e7331890a74b5c8c3a8b119313.jpg&quot; alt=&quot;20171027/c4b537e7331890a74b5c8c3a8b119313.jpg&quot;/&gt;&lt;/p&gt;",
        "goods_price": "88.00",
        "goods_stock": 100,
        "goods_imgs": [
            {
                "img_id": 952,
                "goods_id": 891,
                "key_sn": "2017102718140672791-2",
                "spec_key": "1056",
                "image_url": "/uploads/image/20171027/199601d4dbf7ce4b8634bcc6fcb29911.jpg",
                "image_sort": 0,
                "img": "http://api.yjh.m.com/uploads/image/20171027/199601d4dbf7ce4b8634bcc6fcb29911.jpg"
            },
            {
                "img_id": 953,
                "goods_id": 891,
                "key_sn": "2017102718140672791-2",
                "spec_key": "1056",
                "image_url": "/uploads/image/20171027/b3bce2120134c201e468de09416f3042.jpg",
                "image_sort": 0,
                "img": "http://api.yjh.m.com/uploads/image/20171027/b3bce2120134c201e468de09416f3042.jpg"
            },
            {
                "img_id": 954,
                "goods_id": 891,
                "key_sn": "2017102718140672791-2",
                "spec_key": "1056",
                "image_url": "/uploads/image/20171027/b9e2ec2f07dccab7eb1f88e8787787a1.jpg",
                "image_sort": 0,
                "img": "http://api.yjh.m.com/uploads/image/20171027/b9e2ec2f07dccab7eb1f88e8787787a1.jpg"
            }
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



