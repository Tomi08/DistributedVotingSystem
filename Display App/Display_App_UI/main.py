import msvcrt
import portalocker
import time
import threading
import wx
from wx import Colour

APP_EXIT = 1


class MyFrame(wx.Frame):
    def __init__(self, *args, **kw):
        super().__init__(*args, **kw)
        self.shst = None
        self.statusbar = None

        self.vote_summary = ""
        self.static_text = "This program is going to display the votes sent to this display!\n" \
                           "If your vote did not arrive please try again later!"

        self.my_display = None
        self.start_button = None
        self.reset_button = None

        self.panel = None
        self.initUI()

    def initUI(self):
        super().__init__(parent=None)
        self.panel = wx.Panel(self)

        '''SETTING THE FRAME SIZE, TITLE, BACKGROUND COLOR AND CENTERING IT'''
        self.Centre()
        self.SetSize((450, 300))
        self.SetTitle(title='Vote Displayer')
        self.panel.SetBackgroundColour(Colour(255, 140, 0, 255))

        '''TEXTBOX'''
        self.my_display = wx.TextCtrl(self.panel, style=wx.TE_MULTILINE)
        self.my_display.SetValue(self.static_text)

        '''BUTTONS CREATING AND BINDING'''
        self.start_button = wx.Button(self.panel, label='Start displaying the votes!')
        self.reset_button = wx.Button(self.panel, label='Reset!')
        self.start_button.Bind(wx.EVT_BUTTON, self.OnStartButtonPress)
        self.reset_button.Bind(wx.EVT_BUTTON, self.OnResetButtonPress)

        '''SIZERS'''
        sizer_vertical = wx.BoxSizer(wx.VERTICAL)
        sizer_vertical.Add(self.my_display, 2, wx.ALL | wx.EXPAND, 5)
        sizer_vertical.Add(self.start_button, 0, wx.ALL | wx.CENTER, 5)
        sizer_vertical.Add(self.reset_button, 0, wx.ALL | wx.CENTER, 5)
        self.panel.SetSizer(sizer_vertical)

        '''CREATING THE MENUBAR'''
        fileMenu = wx.Menu()
        menubar = wx.MenuBar()

        '''CREATE AND APPEND MENU OPTIONS'''
        quit_menu = wx.MenuItem(fileMenu, APP_EXIT, '&Quit\tCtrl+Q')
        quit_menu.SetBitmap(wx.Bitmap('exit1.png'))
        fileMenu.Append(quit_menu)
        fileMenu.AppendSeparator()
        self.Bind(wx.EVT_MENU, self.OnQuit, id=APP_EXIT)
        menubar.Append(fileMenu, '&App')
        self.SetMenuBar(menubar)

    # ######################################## #
    # ########### EVENT HANDLERS ############# #
    # ######################################## #

    def OnQuit(self, event):
        if event:
            self.Close()

    def OnResetButtonPress(self, event):
        if event:
            self.my_display.SetValue(self.static_text)
            self.start_button.Show()
            self.reset_button.Hide()

    def OnStartButtonPress(self, event):
        if event:
            self.start_button.Hide()
            self.reset_button.Show()
            while True:
                with open("../votes.txt", "r+") as file:
                    # msvcrt.locking(file.fileno(), msvcrt.LK_LOCK, msvcrt.LK_RLCK)
                    portalocker.lock(file, portalocker.LOCK_SH)

                    lines = file.readlines()
                    self.vote_summary = "".join(lines)
                    self.my_display.SetValue(self.vote_summary)

                    # msvcrt.locking(file.fileno(), msvcrt.LK_UNLCK, msvcrt.LK_RLCK)
                    portalocker.unlock(file)
                time.sleep(1)


def ui():
    app = wx.App()  # CREATING THE APPLICATION OBJECT
    frame = MyFrame()  # CALLING THE FRAME CREATING CLASS
    frame.Show()  # SHOWING THE CREATED FRAME
    app.MainLoop()  # CALLING THE EVENT LOOP


if __name__ == '__main__':
    ui_thread = threading.Thread(target=ui())
    ui_thread.start()
    ui_thread.join()
