<?php

//�Ҽȷα��� ��Ų �� �ҼȰ�� spage ��Ų �����ϱ�κ�
//���⿡ ������ ������ ���� slogin ��Ų�� spage ��Ų������ ���˴ϴ�.

$email_simple_auth = "1"; //�������� ����� 1 �׷��� ������ 0
$mb_img_size = "1048576"; //������ �̹��� �뷮 ���� 1MB = 1048576 byte
$mb_img_width = "55"; //spage ��Ų���� 55�������� �����ʻ���ũ�Ⱑ �����մϴ�.
$mb_img_height = "55"; //spage ��Ų���� 55�������� �����ʻ���ũ�Ⱑ �����մϴ�.
$use_social_icon = 1; //�ҼȾ������� ������� ���� (spage �Խ��� ��Ų ����)
//spage ��������

/*
 * spage�� �⺻������ ��ü����Ʈ������ ȸ���̹����� sql�� ������� �ʽ��ϴ�.
 * �״������ ��κ� ����ڰ� �̿��ϴ� ��տ� ����� �ξ�
 * Data ���丮�� member_image �������� ȸ�����̵��� �Ϻη� �Ǿ��ִ� �̹���������
 * �����ʷ� ����ϰ� �ֱ� ������ ȸ������ ��Ų��� �̸� �����Ͻþ� �����Ͻø� ����
 * �׷��� �ʰ� ��¿�� ���� �ٸ����� ���Ƿ� ���ε��Ͽ� sql db�� ����ϰ� ����ؾ��Ұ��
 * �Ʒ� �������� �������ֽø� �˴ϴ�.

 * ����!! �� ��Ų���� ��� �״����带 ������� ���۵Ǿ����Ƿ� �ٸ������� ����Ϸ� �ϴ°��
 * �ش� ȯ�濡 �°� ��� �ҽ����ϵ��� �����ؾ� �� ���� �ֽ��ϴ�.
 */

$mb_image_sql = false; // �ҼȻ���ڰ� �ƴ� �ڽ��� ����Ʈȸ���ΰ�� ������ �̹����� sql���� �ҷ��ü� �ֽ��ϴ�.
                       // �̴� BLOB�����Ͱ� �ƴϸ� �������̹����� ���ε�� url�� �ǹ��մϴ�.

$mb_image_table = "mb_7"; // �� sql ������ �̿��Ұ�� ������ ������ ��ϵ� ���̺� �̸��� �ǹ��մϴ�.

?>