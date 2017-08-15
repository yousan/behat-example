# language: en
Feature: ログイン機能
  Scenario: 未ログインユーザがTOPページへアクセスするとログインページが表示される。
    # TOPページへアクセスする
    When I am on the homepage
    # ログインページが表示されている
    Then I should be on "wp-login.php"

  Scenario: ログインに成功するとトップページへ移動する。
    # 前提: ログインページが表示されている
    Given I am on "wp-login.php"
    # ユーザ名を入力する
    When I fill in "user_login" with "yousan"
    # パスワードを入力する
    And I fill in "user_pass" with "password"
    # ログインボタンをクリックする
    And I press "wp-submit"
    # TOPページが表示される
    Then I should be on the homepage

  Scenario: ログインに失敗するとエラーが表示される
    Given I am on "wp-login.php"
    When I fill in the following:
      | user_login | naname |
      | user_pass  | badpassword |
    And I press "wp-submit"
    Then I should see "パスワードが間違っています。"
