<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main_question', function (Blueprint $table) {
            $table->id();//ข้อคำถาม
            $table->string('main_question_name');//คำถาม
            $table->enum('main_question_status',['on','off'])->default('on');
            $table->string('main_question_multiply',10)->nullable();//คะเเนนรวม
            $table->string('main_question_weight',10)->nullable();
            $table->timestamps();
        });
        Schema::create('other_question', function (Blueprint $table) {
            $table->id();//ข้อคำถาม
            $table->string('other_question_name');//คำถาม
            $table->enum('other_question_status',['on','off'])->default('on');
            $table->string('other_question_multiply', 10)->nullable();//คะเเนนรวม
            $table->string('other_question_weight',10)->nullable();
            $table->timestamps();
        });

        Schema::create('assessment_01_score', function (Blueprint $table) {
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('other_question_num');//ทำถาม
            $table->text('other_score');//คะเเนนทุกช้อ
            $table->string('total_score', 10);//คะเเนนรวม
            $table->integer('points');//คะเเนนรวม
            $table->integer('user_num');//ผู้ประเมิน
            $table->integer('round')->nullable();//ผู้ประเมิน
            $table->timestamps();
        });

        Schema::create('assessment_02_score', function (Blueprint $table) {
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('main_question_num');//ทำถาม
            $table->text('other_question_num');//ทำถาม
            $table->text('main_score');//คะเเนนทุกช้อ
            $table->text('other_score');//คะเเนนทุกช้อ
            $table->string('total_score', 10);//คะเเนนรวม
            $table->integer('points');//คะเเนนรวม
            $table->integer('user_num');//ผู้ประเมิน
            $table->integer('round')->nullable();//ผู้ประเมิน
            $table->timestamps();
        });

        Schema::create('self_score', function (Blueprint $table) {
            $table->id();
            $table->integer('personal_num');//ชื่อผู้ถูกประเมิน
            $table->text('main_question_num');//ทำถาม
            $table->text('other_question_num');//ทำถาม
            $table->text('main_score');//คะเเนนทุกช้อ
            $table->text('other_score');//คะเเนนทุกช้อ
            $table->string('total_score', 10);//คะเเนนรวม
            $table->integer('points');//คะเเนนรวม
            $table->integer('round')->nullable();//ผู้ประเมิน
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_question');//ตัวอย่าง!!
        Schema::dropIfExists('other_question');//ตัวอย่าง!!
        Schema::dropIfExists('assessment_01_score');//ตัวอย่าง!!
        Schema::dropIfExists('assessment_02_score');//ตัวอย่าง!!
        Schema::dropIfExists('self_score');//ตัวอย่าง!!
    }
};
