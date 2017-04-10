//
//  ViewController.swift
//  MyNewsDemo
//
//  Created by Hongye Liang on 2017/3/26.
//  Copyright © 2017年 Hongye Liang. All rights reserved.
//

import UIKit



class ViewController: UIViewController {

    var detailURL = "http://www.baidu.com"
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        // 1.设置访问资源 - 百度搜索
        let url = URL(string: "http://localhost/BS/Login.html?_ijt=5mn2qglpfisnb4kqlse7v6del3");

        // 2.建立网络请求
        let request = URLRequest(url: url!);
        
        // 3.加载网络请求
        webView.loadRequest(request)
        
        
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


    @IBOutlet weak var webView: UIWebView!
    
    
    
    
    
}

