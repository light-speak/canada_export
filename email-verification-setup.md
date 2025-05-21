# 邮箱验证功能配置指南

## 代码已完成的部分

1. 已修改 `User` 模型，实现 `MustVerifyEmail` 接口
2. 已添加邮箱验证相关路由
3. 已创建邮箱验证视图
4. 已更新 `AuthController` 的 `register` 方法，在用户注册后发送验证邮件

## 邮件服务器配置

要使邮箱验证功能正常工作，您需要配置邮件服务器。请编辑项目根目录下的 `.env` 文件，添加或修改以下内容：

### 对于测试环境（使用Mailtrap）

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=您的Mailtrap用户名
MAIL_PASSWORD=您的Mailtrap密码
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@canadaexport.com
MAIL_FROM_NAME="Canada Export"
```

### 对于生产环境（使用真实SMTP服务器）

```
MAIL_MAILER=smtp
MAIL_HOST=您的邮件服务器地址
MAIL_PORT=587  # 或者465，取决于您的邮件服务器
MAIL_USERNAME=您的邮箱用户名
MAIL_PASSWORD=您的邮箱密码
MAIL_ENCRYPTION=tls  # 或者ssl，取决于您的邮件服务器
MAIL_FROM_ADDRESS=noreply@canadaexport.com
MAIL_FROM_NAME="Canada Export"
```

## 用户流程

1. 用户注册后，系统会自动发送验证邮件到用户的邮箱
2. 用户需要点击邮件中的验证链接来验证其邮箱
3. 在邮箱验证前，用户无法访问控制台（`/console`）
4. 如果用户未收到验证邮件，可以在验证页面请求重新发送

## 测试邮件功能

要测试邮件功能，您可以：

1. 使用 [Mailtrap](https://mailtrap.io/) 服务（免费）来捕获所有发出的邮件
2. 使用 Laravel 的日志驱动（`MAIL_MAILER=log`），邮件内容将被记录到 `storage/logs/laravel.log` 文件中

## 注意事项

- 确保您的服务器允许外发邮件
- 检查您的邮件服务器是否有发送限制
- 在生产环境中，建议使用专业的邮件发送服务，如 SendGrid、Mailgun 或 Amazon SES 