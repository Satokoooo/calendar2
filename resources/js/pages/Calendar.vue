<template>
  <v-app>
    <!--<v-app-bar color="F5F5F5" app>-->
    <!--  <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
    <!--  <v-toolbar-title>Calendar</v-toolbar-title>-->
    <!--</v-app-bar>-->
    <v-navigation-drawer v-model="drawer" :mini-variant.sync="mini" permanent app>
      <v-list>
        <v-menu offset-x>
          <template v-slot:activator="{ on, attrs }">
            <v-avatar size="53" color="#E0F2F1" class="mx-auto">
              <v-btn size="small" icon v-bind="attrs" v-on="on">
                 <v-icon>fas fa-plus</v-icon>
              </v-btn>
            </v-avatar>
          </template>
          <v-list>
            <v-list-item link>
              <v-list-item-title>予定</v-list-item-title>
            </v-list-item>
            <v-list-item link @click="showTaskResister()">
              <v-list-item-title>タスク</v-list-item-title>
            </v-list-item>
            <v-list-item link @click="showMemoResister()">
              <v-list-item-title>メモ</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
        <v-list-item>
          <v-list-item-title>
            <v-icon>far fa-calendar-alt</v-icon>
          </v-list-item-title>
        </v-list-item>
        <v-list-item>
          <v-list-item-title>
            <v-icon>far fa-check-square</v-icon>
          </v-list-item-title>
        </v-list-item>
        <v-list-item @click="showMemoResister()">
          <v-list-item-title>
            <v-icon>far fa-edit</v-icon>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <!--<v-main>-->
    <!--    <v-row class="fill-height">-->
    <!--      <v-col>-->
    <!--        <v-sheet height="64">-->
    <!--          <v-toolbar-->
    <!--            flat-->
    <!--          >-->
    <!--            <v-btn-->
    <!--              outlined-->
    <!--              class="mr-4"-->
    <!--              color="grey darken-2"-->
    <!--              @click="setToday"-->
    <!--            >-->
    <!--              Today-->
    <!--            </v-btn>-->
    <!--            <v-btn-->
    <!--              fab-->
    <!--              text-->
    <!--              small-->
    <!--              color="grey darken-2"-->
    <!--              @click="prev"-->
    <!--            >-->
    <!--              <v-icon small>-->
    <!--                mdi-chevron-left-->
    <!--              </v-icon>-->
    <!--            </v-btn>-->
    <!--            <v-btn-->
    <!--              fab-->
    <!--              text-->
    <!--              small-->
    <!--              color="grey darken-2"-->
    <!--              @click="next"-->
    <!--            >-->
    <!--              <v-icon small>-->
    <!--                mdi-chevron-right-->
    <!--              </v-icon>-->
    <!--            </v-btn>-->
    <!--            <v-toolbar-title v-if="$refs.calendar">-->
    <!--              {{ $refs.calendar.title }}-->
    <!--            </v-toolbar-title>-->
    <!--            <v-spacer></v-spacer>-->
    <!--            <v-menu-->
    <!--              bottom-->
    <!--              right-->
    <!--            >-->
    <!--              <template v-slot:activator="{ on, attrs }">-->
    <!--                <v-btn-->
    <!--                  outlined-->
    <!--                  color="grey darken-2"-->
    <!--                  v-bind="attrs"-->
    <!--                  v-on="on"-->
    <!--                >-->
    <!--                  <span>{{ typeToLabel[type] }}</span>-->
    <!--                  <v-icon right>-->
    <!--                    mdi-menu-down-->
    <!--                  </v-icon>-->
    <!--                </v-btn>-->
    <!--              </template>-->
    <!--              <v-list>-->
    <!--                <v-list-item @click="type = 'day'">-->
    <!--                  <v-list-item-title>Day</v-list-item-title>-->
    <!--                </v-list-item>-->
    <!--                <v-list-item @click="type = 'week'">-->
    <!--                  <v-list-item-title>Week</v-list-item-title>-->
    <!--                </v-list-item>-->
    <!--                <v-list-item @click="type = 'month'">-->
    <!--                  <v-list-item-title>Month</v-list-item-title>-->
    <!--                </v-list-item>-->
    <!--                <v-list-item @click="type = '4day'">-->
    <!--                  <v-list-item-title>4 days</v-list-item-title>-->
    <!--                </v-list-item>-->
    <!--              </v-list>-->
    <!--            </v-menu>-->
    <!--          </v-toolbar>-->
    <!--        </v-sheet>-->
    <!--        <v-sheet height="600">-->
    <!--          <v-calendar-->
    <!--            ref="calendar"-->
    <!--            v-model="focus"-->
    <!--            color="primary"-->
    <!--            :events="events"-->
    <!--            :event-color="getEventColor"-->
    <!--            :type="type"-->
    <!--            @click:event="showEvent"-->
    <!--            @click:more="viewDay"-->
    <!--            @click:date="viewDay"-->
    <!--            @change="updateRange"-->
    <!--          ></v-calendar>-->
    <!--          <v-menu-->
    <!--            v-model="selectedOpen"-->
    <!--            :close-on-content-click="false"-->
    <!--            :activator="selectedElement"-->
    <!--            offset-x-->
    <!--          >-->
    <!--            <v-card-->
    <!--              color="grey lighten-4"-->
    <!--              min-width="350px"-->
    <!--              flat-->
    <!--            >-->
    <!--              <v-toolbar-->
    <!--                :color="selectedEvent.color"-->
    <!--                dark-->
    <!--              >-->
    <!--                <v-btn icon>-->
    <!--                  <v-icon>mdi-pencil</v-icon>-->
    <!--                </v-btn>-->
    <!--                <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>-->
    <!--                <v-spacer></v-spacer>-->
    <!--                <v-btn icon>-->
    <!--                  <v-icon>mdi-heart</v-icon>-->
    <!--                </v-btn>-->
    <!--                <v-btn icon>-->
    <!--                  <v-icon>mdi-dots-vertical</v-icon>-->
    <!--                </v-btn>-->
    <!--              </v-toolbar>-->
    <!--              <v-card-text>-->
    <!--                <span v-html="selectedEvent.details"></span>-->
    <!--              </v-card-text>-->
    <!--              <v-card-actions>-->
    <!--                <v-btn-->
    <!--                  text-->
    <!--                  color="secondary"-->
    <!--                  @click="selectedOpen = false"-->
    <!--                >-->
    <!--                  Cancel-->
    <!--                </v-btn>-->
    <!--              </v-card-actions>-->
    <!--            </v-card>-->
    <!--          </v-menu>-->
    <!--        </v-sheet>-->
    <!--      </v-col>-->
    <!--    </v-row>-->
    <!--  <v-container fluid>-->
    <!--    <v-row>-->
    <!--      <v-col v-for="memo in memos" :key="memo" cols="5" md="4">-->
    <!--        <v-card class="mb-5">-->
    <!--          <v-card-item>-->
    <!--            <div>-->
    <!--              <div class="text-overline mb-1"></div>-->
    <!--              <div v-text="memo.title" class="text-h6 mb-1"></div>-->
    <!--              <div v-text="memo.text" class="text-caption"></div>-->
    <!--            </div>-->
    <!--          </v-card-item>-->
    <!--          <v-card-actions>-->
    <!--            <v-btn @click="showEditMemo(memo)" variant="outlined">編集</v-btn>-->
    <!--            <v-btn @click="deleteMemo(memo.id,index)" variant="outlined">削除</v-btn>-->
    <!--          </v-card-actions>-->
    <!--        </v-card>-->
    <!--      </v-col>-->
    <!--    </v-row>-->
    <!--  </v-container>-->
    <!--</v-main>-->
    <v-container fill-height justify="center" style="width: 500px;" class="ma-auto" v-if="editMemo">
      <v-card class="py-12 px-5" >
        <v-card-title>メモ編集</v-card-title>
        <v-form>
          <v-col cols="12">
            <v-text-field
              label="タイトル"
              name="title"
              type="text"
              v-model="memoTitle"
              ref="editor"
            />
          </v-col>
          <v-col cols="12">
            <v-textarea
              label="テキスト"
              name="text"
              type="text"
              v-model="memoText"
              ref="editor"
            />
          </v-col>
        </v-form>
        <v-row justify="center">
          <v-btn @click="closeMemoResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>
          <v-btn @click="updateMemo()" color="#66BB6A" class="mx-2">更新</v-btn>
        </v-row>
      </v-card>
    </v-container>
    <v-container fill-height justify="center" class="ma-auto" v-if="memoResister">
      <v-card class="py-12 px-5" style="width: 500px;">
        <v-card-title>メモ登録</v-card-title>
        <v-form>
          <v-col cols="12">
            <v-text-field
              label="タイトル"
              name="title"
              type="text"
              v-model="memoTitle"
            />
          </v-col>
          <v-col cols="12">
            <v-textarea
              label="テキスト"
              name="text"
              type="text"
              v-model="memoText"
            />
          </v-col>
        </v-form>
        <v-row justify="center">
          <v-btn @click="closeMemoResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>
          <v-btn @click="createNewMemo()" color="#66BB6A" class="mx-2">登録</v-btn>
        </v-row>
      </v-card>
    </v-container>
    <!--<Task />-->
  </v-app>
</template>
// <script>
// export default {
//     data: () => ({
//       mini: true,
//       drawer: true,
//       memoResister: false,
//       editMemo: false,
//       memos: {},
//       memoTitle: "",
//       memoText: "",
//       memoId: "",
//       focus: '',
//       type: 'month',
//       typeToLabel: {
//         month: 'Month',
//         week: 'Week',
//         day: 'Day',
//         '4day': '4 Days',
//       },
//       selectedEvent: {},
//       selectedElement: null,
//       selectedOpen: false,
//       events: [],
//       colors: ['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'],
//       names: ['Meeting', 'Holiday', 'PTO', 'Travel', 'Event', 'Birthday', 'Conference', 'Party']
//     }),
//     methods: {
//       createNewMemo:function(){
//         //axios.post(URL, data jsの構造体)
//         axios.post('/api/memo', {title:this.memoTitle, text:this.memoText})
//         .then((response) => {
//           console.log(response);
//         })
//         .catch((error) => {
//           console.log(error);
//         });
//       },
//       deleteMemo:function(id,index){
//         axios.delete('/api/memos/' + id)
//         .then((response) => {
//           console.log(response);
//           this.memos.splice(index,1);
//         })
//         .catch((error) => {
//           console.log(error);
//         });
//       },
//       showEditMemo:function(memo){
//         this.editMemo = "true";
//         console.log(memo);
//         this.memoTitle = memo.title;
//         this.memoText = memo.text;
//         this.memoId = memo.id;
//         // this.$refs.editor.focus();
        
//       },
//       updateMemo:function(){
//         axios.patch('/api/memos/' + this.memoId, {title:this.memoTitle, text:this.memoText})
//         .then((response) => {
//             console.log(response);
//             // memo.title = this.memoTitle;
//             // memo.text = this.memoText;
//         }).catch((error) => {
//             console.log(error);
//         });
//       },
//       showMemoResister:function(){
//         this.memoResister = true;
//         console.log(this.memoResister);
//       },
//       closeMemoResister:function(){
//         this.memoResister = false;
//       }
//     },
//     mounted: function() {
//       // メモデータを取得表示
//       let self = this;
//       axios.get('/ajax/memo')
//       .then(function(response){
//         self.memos = response.data;
//       });
//       this.$refs.calendar.checkChange();
//     }
//   }